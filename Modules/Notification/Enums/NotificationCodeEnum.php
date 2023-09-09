<?php

declare(strict_types=1);

namespace Modules\Notification\Enums;

enum NotificationCodeEnum: string
{
    case AddedNewGame = 'added_new_game';

    case NewGameVersion = 'new_game_version';
}
