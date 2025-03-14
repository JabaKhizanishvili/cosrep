<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SecondNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($appointment, $customer)
    {
        $this->appointment = $appointment;
        $this->customer = $customer;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("ტრენინგის შეხსენება - " . config('meta.company_short_name'))->markdown('emails.SecondNotificationMail')->with([
            'training_name' => $this->appointment->training->name,
            'start_date' => $this->appointment->start_date,
            'duration' => $this->appointment->getDuration(),
            'username' => $this->customer->username,
            'name' => $this->customer->name,
            'email' => $this->customer->email,
            'appointment' => $this->appointment,
        ]);
    }
}
