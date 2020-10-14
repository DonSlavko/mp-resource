<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegister extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data) {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->from('registrierung@mp-resource.shop', 'Medical Pharma Resource (MPR) – Onlineshop')
            ->subject('Medical Pharma Resource (MPR) – Onlineshop: Registrierung bestätigen bitte.')
            ->view('email.user_register');
    }
}
