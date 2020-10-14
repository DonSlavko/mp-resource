<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegisterAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $from = [
        [
            'address' => 'verifizierung@mp-resource.shop',
            'name' => 'Medical Pharma Resource (MPR) – Onlineshop'
        ]
    ];
    public $subject = 'Medical Pharma Resource (MPR) – Onlineshop: Registrierung bestätigen bitte.';
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user) {
        $this->data = [
            'titles' => $user->title,
            'honorific' => $user->honorific,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'username' => $user->username,
            'email' => $user->email,
        ];

        $uploads = $user->getMedia('upload_files');

        if (!$uploads->isEmpty()) {

            $this->attachments = $uploads->map(function ($file) {
                return [
                    'file' => $file->getFullUrl()
                ];
            });
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->view('email.user_register');
    }
}
