<?php

namespace App\Console\Commands;

use Throwable;
use App\Models\Appointment;
use Illuminate\Console\Command;
use App\Models\AppointmentCustomer;
use App\Mail\SecondNotificationMail;
use Illuminate\Support\Facades\Mail;

class SendSecondNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'second:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $to = date("Y-m-d H:i:s", strtotime("+ 3 Hour"));
        $from = date("Y-m-d H:i:s", strtotime("+ 1 Hour"));

        $appointments = Appointment::future()
            ->whereDate('start_date', date("Y-m-d"))
            ->whereBetween('start_date', [$from, $to])
            ->with(['customers', 'customers.customer'])->get();

        foreach ($appointments as $appointment) {

            $customers = $appointment->customers()->notifyTwo()->skip(0)->take(20)->get();

            foreach ($customers as $customer) {
                sleep(5);
                try {

                    //send mail to consultant
                    Mail::to($customer->customer->email)->send(new SecondNotificationMail($appointment, $customer->customer));

                    $customer->notified = AppointmentCustomer::NOTIFIED_TWO;
                    $customer->save();
                } catch (Throwable $e) {
                    report($e);
                }
            }
        }
    }
}
