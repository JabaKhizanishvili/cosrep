<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;

    public const ACTIVE = 1;
    public const INACTIVE = 2;

    public const SORT_ARRAY = [
        // 'customers' => 'Customers +',
        // 'customers-' => 'Customers -',
        'created_at' => 'Created At +',
        'created_at-' => 'Created At -',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'office_id',
        'position_id',
        'username',
        'color',
        'group_number'
    ];

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    public function appointments()
    {
        return $this->belongsToMany(Appointment::class, 'appointment_customers', 'customer_id', 'appointment_id')->with('training')->withPivot('finished_at', 'point_to_pass', 'final_point')->orderBy('start_date', 'desc');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function username()
    {
        return 'username';
    }
}
