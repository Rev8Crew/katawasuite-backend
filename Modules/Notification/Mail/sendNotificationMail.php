<?php

namespace Modules\Notification\Mail;

use Crypt;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Modules\Notification\Models\NotificationRelease;
use Modules\User\Entities\User;

class sendNotificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public NotificationRelease $release
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            to: [new Address($this->user->email, $this->user->name)],
            subject: 'Send Notification',
        );
    }

    public function content(): Content
    {
        $title = $this->release->title;
        $body = $this->release->body;
        $email = Crypt::encryptString($this->user->email);
        $type = $this->release->notification->code;

        return new Content(
            view: 'notifications::emails.send-notification',
            with: compact('title', 'body', 'email', 'type')
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
