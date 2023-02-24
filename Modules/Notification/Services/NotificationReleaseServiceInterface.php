<?php

declare(strict_types=1);

namespace Modules\Notification\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Notification\Models\NotificationRelease;
use Modules\User\Entities\User;

interface NotificationReleaseServiceInterface
{
    public function release(NotificationRelease $release): void;

    public function send(User $user, NotificationRelease $release): void;

    public function getReleasesByUser(User $user): Collection;
}
