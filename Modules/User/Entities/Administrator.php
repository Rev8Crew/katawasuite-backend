<?php
declare(strict_types=1);

namespace Modules\User\Entities;

use Illuminate\Notifications\Notifiable;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;

class Administrator extends \Encore\Admin\Auth\Database\Administrator
{
    use Notifiable, AuthenticationLoggable;
}
