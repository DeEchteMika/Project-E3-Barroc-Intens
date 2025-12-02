<?php

namespace App\Mail;

use App\Models\Klant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProcessCompleted extends Mailable
{
    use Queueable, SerializesModels;

    /** @var Klant|null */
    public $klant;

    public function __construct(?Klant $klant = null)
    {
        $this->klant = $klant;
    }

    public function build()
    {
        return $this->subject('Proces voltooid - Test')
            ->view('emails.process_completed')
            ->with(['klant' => $this->klant]);
    }
}
