<?php

namespace App\Mail;

use App\Models\OnderhoudSchema;
use App\Models\Medewerker;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MonteurToegewezen extends Mailable
{
    use Queueable, SerializesModels;

    public $onderhoud;
    public $monteur;
    public $klant;

    /**
     * Create a new message instance.
     */
    public function __construct(OnderhoudSchema $onderhoud, Medewerker $monteur)
    {
        $this->onderhoud = $onderhoud;
        $this->monteur = $monteur;
        $this->klant = $onderhoud->klant;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Monteur Toegewezen voor Onderhoud',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.monteur-toegewezen',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
