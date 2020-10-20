<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserOrderAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $from, $files, $subject)
    {
        $this->data = [
            'order' => $order,
            'name' => $order->user->username,
            'user_email' => $order->user->email
        ];
        $this->from = $from;
        $this->subject = $subject;


        $this->attachments = $files;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.PreOrder_mail_to_admin');
    }
}
