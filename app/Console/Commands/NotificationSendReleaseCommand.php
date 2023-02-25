<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Notification\Models\NotificationRelease;
use Modules\Notification\Services\NotificationReleaseServiceInterface;

class NotificationSendReleaseCommand extends Command
{
    protected $signature = 'notification:send-release {id}';

    protected $description = 'Command description';

    public function handle(NotificationReleaseServiceInterface $notificationReleaseService): void
    {
        $release = NotificationRelease::findOrFail($this->argument('id'));
        $release->load(['notification.users']);

        $chunks = $release->notification->users->chunk(25);
        $bar = $this->output->createProgressBar($chunks->count());
        foreach ($release->notification->users->chunk(25) as $userChunk) {

            foreach ($userChunk as $user) {
                $notificationReleaseService->send($user, $release);
            }

            $bar->advance();
        }

        // Сохраним пользователей, которым было отправлено данное уведомление, т.к. список может меняться
        $release->notificationDelivery()->saveMany($release->notification->users);

        $bar->finish();
    }
}
