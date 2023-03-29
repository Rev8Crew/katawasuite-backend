<?php

namespace App\Listeners;

use Illuminate\Mail\Events\MessageSending;

class MailSendingListener
{
    public function __construct()
    {
    }

    public function handle(MessageSending $event): bool
    {
        $emails = collect($event->message->getTo())
            ->map(fn ($item) => $item->getAddress());

        foreach ($emails as $email) {
            if (\Str::contains($email, '@admin.com')) {
                return false;
            }
        }

        return true;
    }
}
