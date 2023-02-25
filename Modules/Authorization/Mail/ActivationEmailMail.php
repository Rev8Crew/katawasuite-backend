<?php

namespace Modules\Authorization\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Modules\User\Entities\User;

class ActivationEmailMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public string $token
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            to: [new Address($this->user->email, $this->user->name)],
            subject: trans('authorization::authorization.activation_email_subject')
        );
    }

    public function content(): Content
    {
        $token = $this->token;

        return new Content(
            view: 'authorization::emails.activation-email',
            with: [
                'url' => URL::route('auth.verify', compact('token')),
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
