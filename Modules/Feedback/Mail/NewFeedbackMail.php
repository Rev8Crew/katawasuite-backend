<?php

namespace Modules\Feedback\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Modules\Feedback\Entities\Feedback;

class NewFeedbackMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Feedback $feedback)
    {
    }

    public function envelope(): Envelope
    {
        $email = config('app.author_email');
        $name = config('app.author_name');

        return new Envelope(
            to: [new Address($email, $name)],
            subject: trans('feedback::feedback.new_feedback_mail'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'feedback::emails.new-feedback',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
