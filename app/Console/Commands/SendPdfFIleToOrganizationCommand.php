<?php

namespace App\Console\Commands;

use App\Models\Settings;
use Throwable;
use App\Models\Customer;
use App\Models\Appointment;
use PDF;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\AppointmentCustomer;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendPdfToOrganizationMail;

class SendPdfFIleToOrganizationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:pdf';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send pdf file to Organizations';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $lang;

    public function __construct()
    {
        parent::__construct();
        $this->lang = Settings::get('email_language', 'ge');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $appointment = Appointment::with('training', 'training.trainer')->done()->needsToReport()->orderBy('end_date')->first();
        $this->sendPdf($appointment);
    }

    public function sendPdf($appointment)
    {
        //get oldest appointment which was not reported

        if (empty($appointment)) {
            return;
        }
        $training = $appointment->training;

        //get appointment customers
        $appointmentCustomers = AppointmentCustomer::needsToReport()->with('customer', 'customer.office', 'customer.office.organization')->where('appointment_id', $appointment->id)->passed()->get();

        //if all is reported fetch next appointment
        if (count($appointmentCustomers) === 0) {
            $appointment->reported = true;
            $appointment->save();
            $appointment = Appointment::done()->needsToReport()->orderBy('end_date')->first();
            $appointmentCustomers = AppointmentCustomer::needsToReport()->with('customer', 'customer.office', 'customer.office.organization')->where('appointment_id', $appointment->id)->passed()->get();
        }

        if (count($appointmentCustomers) == 0) {

            $appointment->reported = true;
            $appointment->save();
            return;
        }

        //split by office
        $officeCustomers = $appointmentCustomers->groupBy('customer.office_id')->first();

        if (count($officeCustomers) == 0) {

            return;
        }

        //get organization and check if email is set
        $office = $officeCustomers->first()->customer->office;
        $organization = $officeCustomers->first()->customer->office->organization;

        if (empty($organization->email)) {
            $appointment = Appointment::done()->needsToReport()->where('id', '>', $appointment->id)->orderBy('end_date')->first();
            $this->sendPdf($appointment);
            return;
        }

        $data = [];
        $customer_ids = $officeCustomers->pluck('customer_id')->toArray();
        $customers = Customer::with('position')->whereIn('id', $customer_ids)->get();
        $pdfName = date("d-M-Y_H-i", strtotime($appointment->start_date)) . ' - ' . $appointment->training->name . ' - ' . $organization->name . ' - ' . $office->name . '.pdf';


        $data = [
            'training_name' => $training->name,
            'media' => $training->media,
            'trainer_name' => $training->trainer->name,
            'start_date' => $appointment->getStartDate(),
            'end_date' => $appointment->getEndDate(),
            'office' => $office,
            'organization' => $office->organization,
            'customers' => $customers,
            'trainer_signature' => signatureImage($training->trainer->signature),
            'documentName' => $pdfName,
            'lang' => $this->lang,

        ];

        try {
            $pdf = PDF::loadView('emails.pdf', $data);

            Mail::to($organization->email)->send(new SendPdfToOrganizationMail($data, $pdf->output()));

            DB::beginTransaction();
            foreach ($officeCustomers as $officeCustomer) {
                $officeCustomer->reported = true;
                $officeCustomer->save();
            }
            DB::commit();
        } catch (Throwable $e) {
            report($e);
        }
    }
}
