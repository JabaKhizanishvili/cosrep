<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FirstNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($appointment, $customer, $password)
    {
        $this->appointment = $appointment;
        $this->customer = $customer;
        $this->password = $password;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("რეგისტრაცია ტრენინგზე - " . config('meta.company_short_name'))->markdown('emails.FirstNotificationMail')->with([
            'training_name' => $this->appointment->training->name,
            'start_date' => $this->appointment->start_date,
            'duration' => $this->appointment->getDuration(),
            'name' => $this->customer->name,
            'email' => $this->customer->email,
            'username' => $this->customer->username,
            'password' => $this->password,
            'appointment' => $this->appointment,
        ]);
    }
}
