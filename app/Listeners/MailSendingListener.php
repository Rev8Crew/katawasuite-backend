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
        foreach ($event->message->getTo() as $email) {
            if (\Str::contains($email->getAddress(), '@admin.com')) {
                return false;
            }
        }

        return true;
    }
}
