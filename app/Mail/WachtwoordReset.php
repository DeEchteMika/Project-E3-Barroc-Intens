<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WachtwoordReset extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $email;
    public $userName;

    /**
     * Create a new message instance.
     *
     * @param string $token
     * @param string $email
     * @param string|null $userName
     */
    public function __construct(string $token, string $email, ?string $userName = null)
    {
        $this->token = $token;
        $this->email = $email;
        $this->userName = $userName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $this->email,
        ], false));

        return $this->subject('Wachtwoord Reset Aanvraag - Barroc Intens')
            ->view('emails.wachtwoord_reset')
            ->with([
                'resetUrl' => $resetUrl,
                'userName' => $this->userName,
                'email' => $this->email,
            ]);
    }
}
