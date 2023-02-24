<?php
declare(strict_types=1);

namespace Modules\Notification\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Mail;
use Modules\Notification\Mail\sendNotificationMail;
use Modules\Notification\Models\NotificationRelease;
use Modules\User\Entities\User;

class NotificationReleaseService implements NotificationReleaseServiceInterface
{

    public function release(NotificationRelease $release): void
    {
        $release->load('notification.users');

        foreach ($release->notification->users as $user) {
            $this->send($user, $release);
        }

        // Сохраним пользователей, которым было отправлено данное уведомление, т.к. список может меняться
        $release->notificationDelivery()->saveMany($release->notification->users);
    }

    public function send(User $user, NotificationRelease $release): void
    {
        Mail::send(new sendNotificationMail($user, $release));
    }

    public function getReleasesByUser(User $user): Collection
    {
        return NotificationRelease::whereHas('notificationDelivery', function (Builder $builder) use ($user) {
            $builder->where('user_id', $user->id);
        })->get();
    }
}
