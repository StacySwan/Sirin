<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Письмо администратору о новой заявке с сайта.
 */
class LeadMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $lead)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Новая заявка с сайта: ' . ($this->lead['subject_title'] ?? '' ?: 'без темы'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.lead',
            with: ['lead' => $this->lead],
        );
    }
}
