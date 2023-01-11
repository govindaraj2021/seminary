<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;


    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
   
        return $this->from('nnomai@gmail.com', 'Hotel Crystal Suites')
        ->replyTo($this->data['email']?$this->data['email']:'alphonsa@gmail.com', $this->data['name'])
            ->subject($this->data['name'] . ' | Contact Enquiry')
            ->markdown('emails.contact.received');
    }
}
