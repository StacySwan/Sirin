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
        /**
         * Настройки письма: тема, отправитель, reply-to.
 */
    {
        return new Envelope(
            subject: 'Новая заявка с сайта: ' . ($this->lead['subject_title'] ?? '' ?: 'без темы'),
        );
    }

    public function content(): Content
        /**
     настраивается через блейд шаблон
     */
    {
        return new Content(
            view: 'emails.lead',
            with: ['lead' => $this->lead],
        );
    }
}

/**
Пользователь заполняет форму.
2. Браузер отправляет POST-запрос.
3. StoreLeadRequest проверяет данные.
4. Если данные неправильные — письмо не отправляется.
5. Если данные правильные — создаётся массив $lead.
6. Создаётся объект new LeadMail($lead).
7. Метод envelope() формирует тему.
8. Метод content() выбирает Blade-шаблон.
9. Blade подставляет данные в HTML.
10. Mail::send() отправляет письмо администратору.
 */
