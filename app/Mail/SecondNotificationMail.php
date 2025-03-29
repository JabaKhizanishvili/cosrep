<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Settings;

class SecondNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($appointment, $customer, $pwd)
    {
        $this->appointment = $appointment;
        $this->customer = $customer;
        $this->password = $pwd;
        $this->lang = Settings::get('email_language', 'ge');

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emailSubject = '';
        if ($this->lang == 'ge') {
            $emailSubject = 'ტრენინგის შეხსენება - ';
        } else {
            $emailSubject = 'Training remainder - ';
        }

        return $this->subject($emailSubject . config('meta.company_short_name'))->markdown('emails.SecondNotificationMail')->with([
            'training_name' => $this->appointment->training->name,
            'start_date' => $this->appointment->start_date,
            'duration' => $this->appointment->getDuration(),
            'username' => $this->customer->username,
            'password' => $this->password,
            'name' => $this->customer->name,
            'email' => $this->customer->email,
            'appointment' => $this->appointment,
            'lang' => $this->lang,
        ]);
    }
}
