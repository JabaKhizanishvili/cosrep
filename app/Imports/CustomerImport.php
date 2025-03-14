<?php

namespace App\Imports;

use Exception;
use App\Models\Customer;
use App\Models\Position;
use PhpParser\Node\Expr\Throw_;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CustomerImport implements ToModel, WithEvents, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public $office_id;
    public $groupId;
    public $color;

    public function __construct($office_id, $groupId, $color)
    {
        $this->office_id = $office_id;
        $this->groupId = $groupId;
        $this->color = $color;
    }

    public function registerEvents(): array
    {
        return [
            BeforeImport::class => function (BeforeImport $event) {
                $totalRows = $event->getReader()->getTotalRows();

                if (!empty($totalRows)) {
                    $max_allowed_customer_import_rows = config('meta.max_allowed_customer_import_rows');

                    $totalRows = $totalRows['Sheet1'];
                    if ($totalRows > $max_allowed_customer_import_rows) {
                        throw new Exception("Number Of rows Exceeded, Allowed $max_allowed_customer_import_rows, document contains $totalRows");
                    }
                }
            }
        ];
    }

    public function model(array $row)
    {
        //validate excel data
        $resContent = json_encode($row, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $personalNumber = $row[0] ?? null;
        $email = $row[1] ?? null;
        $name = $row[2] ?? null;
        $positionName = $row[3] ?? null;


        if (empty($personalNumber) && empty($email) && empty($name) && empty($positionName)) {
            return null;
        }
        //username (personal number) field is empty
        if (!isset($row[0])) {
            Log::channel('customer_import')->info("Personal Number Field is empty: " . $resContent);
            return null;
        }

        //if email field is empty
        if (!isset($row[1])) {
            Log::channel('customer_import')->info("Email Field is empty: " . $resContent);
            return null;
        }

        //name field is empty
        if (!isset($row[2])) {
            Log::channel('customer_import')->info("Name Field is empty: " . $resContent);
            return null;
        }

        //position field is empty
        if (!isset($row[3])) {
            Log::channel('customer_import')->info("Position Field is empty: " . $resContent);
            return null;
        }

        //invalid personal number
        //length
        $num_length = strlen((string)$row[0]);
        if ($num_length != 11) {
            Log::channel('customer_import')->info("Personal number length is invalid: " . $resContent);
            return null;
        }
        //if personal number is not numeric
        if (!is_numeric($row[0])) {
            Log::channel('customer_import')->info("Personal number needs to be integer: " . $resContent);
            return null;
        }

        //invalid email
        if (!filter_var($row[1], FILTER_VALIDATE_EMAIL)) {
            Log::channel('customer_import')->info("Invalid Email Format: " . $resContent);
            return null;
        }

        //customer already exists
        $customer = Customer::where("username", $row[0])->first();
        if ($customer) {
            Log::channel('customer_import')->info("Customer Already Exists: " . $resContent);
            return null;
        }

        //check if we have position in our database
        $position = Position::whereRaw('LOWER(name) = ?', [strtolower($row[3])])->first();

        if (empty($position)) {
            //create position
            $position = new Position();
            $position->name = $row[3];
            $position->save();
        }

        //position
        return new Customer([
            'username'     => $row[0],
            'email'     => $row[1],
            'name'     => $row[2],
            'office_id'     => $this->office_id,
            'group_number'     => $this->groupId,
            'color'     => $this->color,
            'position_id'     => $position->id,
        ]);
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
