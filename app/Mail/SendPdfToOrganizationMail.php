<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPdfToOrganizationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $file)
    {
        $this->file = $file;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->data['lang'] == 'en') {
            $subject = 'Record Book';
        } else {
            $subject = 'აღრიცხვის ჟურნალი';
        }

        return $this->subject("$subject - " . config('meta.company_short_name'))->markdown('emails.SendPdfToOrganizationMail')->with([
            'training_name' => $this->data['training_name'],
            'start_date' => $this->data['start_date'],
            'end_date' => $this->data['end_date'],
            'office' => $this->data['office'],
            'organization' => $this->data['organization'],
            'lang' => $this->data['lang'],

        ])->attachData($this->file, $this->data['documentName']);
    }
}
