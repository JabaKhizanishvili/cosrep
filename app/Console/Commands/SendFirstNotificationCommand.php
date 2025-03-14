<?php

namespace App\Console\Commands;

use Throwable;
use App\Models\Appointment;
use Illuminate\Console\Command;
use App\Mail\FirstNotificationMail;
use App\Models\AppointmentCustomer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class SendFirstNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'first:notification';

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
        $appointments = Appointment::future()
            ->whereDate('start_date', date("Y-m-d", strtotime("+ 1 Day")))
            ->with(['customers', 'customers.customer'])->get();

        foreach ($appointments as $appointment) {

            $customers = $appointment->customers()->notifyOne()->skip(0)->take(20)->get();

            foreach ($customers as $customer) {
                sleep(5);
                try {
                    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
                    $pwd = substr(str_shuffle($chars), 0, 8);

                    $password = Hash::make($pwd);
                    $customer->customer->password = $password;
                    $customer->customer->save();
                    //send mail to consultant
                    Mail::to($customer->customer->email)->send(new FirstNotificationMail($appointment, $customer->customer, $pwd));

                    $customer->notified = AppointmentCustomer::NOTIFIED_ONE;
                    $customer->save();
                } catch (Throwable $e) {

                    report($e);
                }
            }
        }
    }
}
