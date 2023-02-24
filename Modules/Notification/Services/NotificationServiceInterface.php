<?php

declare(strict_types=1);

namespace Modules\Notification\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Notification\Models\Notification;
use Modules\User\Entities\User;
use Webmozart\Assert\InvalidArgumentException;

interface NotificationServiceInterface
{
    public function getAll(): Collection;

    /**
     * @throws InvalidArgumentException
     */
    public function getByCode(string $code): Notification;

    public function subscribeToAll(User $user): void;

    public function unsubscribeToAll(User $user): void;

    public function subscribe(User $user, Notification $notification): void;

    public function unsubscribe(User $user, Notification $notification): void;
}
