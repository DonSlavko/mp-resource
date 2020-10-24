<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $pdf, $from, $subject)
    {
        $this->data = $data;
        $this->from = $from;
        $this->subject = $subject;
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('email.PreOrder_mail_to_customer')->attachData($this->pdf, 'preorder.pdf');
    }
}
