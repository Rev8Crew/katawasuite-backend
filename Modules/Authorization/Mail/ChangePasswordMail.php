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

class ChangePasswordMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            to: [new Address($this->user->email, $this->user->name)],
            subject: trans('authorization::authorization.change_password_subject'),
        );
    }

//изменить (убрать окно с кнопкой)
    public function content(): Content
    {

        return new Content(
            view: 'authorization::emails.change-password',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
