<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $object;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($object)
    {
        $this->object = $object;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (isset($this->object['personal_number'])) {
            $subject = 'წერილი ტრენერთან';
        } else {
            $subject = 'წერილი საკონტაქტო ფორმიდან';
        }

        return $this->subject($subject . " - " . config('app.url'))->markdown('emails.contactEmail')->with([
            'name' => $this->object['name'],
            'email' => $this->object['email'],
            'text' => $this->object['text'],
            'trainer_email' => $this->object['trainer_email'] ?? null,
            'phone' => $this->object['phone'] ?? null,
            'personal_number' => $this->object['personal_number'] ?? null,
            'training_name' => $this->object['training_name'] ?? null,
        ]);
    }
}
