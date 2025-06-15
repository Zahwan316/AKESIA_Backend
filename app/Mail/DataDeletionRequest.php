<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DataDeletionRequest extends Mailable
{
    use Queueable, SerializesModels;

    public array $requestData;
    /**
     * Create a new message instance.
     */
    public function __construct($requestData)
    {
        //
        $this->requestData = $requestData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Permintaan Penghapusan Data Akesia',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'email.data-deletion-request',
            with: [
                'email' => $this->requestData['email'],
                'reason' => $this->requestData['reason'] ?? 'Tidak disebutkan',
                'verification_url' => $this->requestData['verification_url']
            ]
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
