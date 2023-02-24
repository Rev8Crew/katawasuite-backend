<?php

declare(strict_types=1);

namespace Modules\Notification\Services;

use App\Enums\ActiveStatusEnum;
use Illuminate\Database\Eloquent\Collection;
use Modules\Notification\Models\Notification;
use Modules\User\Entities\User;
use Webmozart\Assert\Assert;

class NotificationService implements NotificationServiceInterface
{
    public function getAll(): Collection
    {
        return Notification::where('is_active', ActiveStatusEnum::Active->value)->get();
    }

    public function subscribeToAll(User $user): void
    {
        $this->getAll()->each(function (Notification $notification) use ($user) {
            $this->subscribe($user, $notification);
        });
    }

    public function unsubscribeToAll(User $user): void
    {
        $this->getAll()->each(function (Notification $notification) use ($user) {
            $this->unsubscribe($user, $notification);
        });
    }

    public function subscribe(User $user, Notification $notification): void
    {
        if ($user->notifications()->wherePivot('notification_id', $notification->id)->count() === 0) {
            $user->notifications()->save($notification);
        }
    }

    public function unsubscribe(User $user, Notification $notification): void
    {
        $user->notifications()->wherePivot('notification_id', $notification->id)->detach();
    }

    public function getByCode(string $code): Notification
    {
        $model = Notification::whereCode($code)->first();

        Assert::notNull($model, "Can't find Notification");

        return $model;
    }
}
