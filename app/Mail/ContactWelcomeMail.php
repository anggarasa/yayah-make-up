<?php

namespace App\Mail;

use App\Models\QuestionWelcome;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $question;
    
    /**
     * Create a new message instance.
     */
    public function __construct(QuestionWelcome $question)
    {
        $this->question = $question;
    }

    public function build()
    {
        return $this->markdown('emails.contact-welcome-mail')
                    ->subject('Pertanyaan Anda Telah Dijawab');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact Welcome Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
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
