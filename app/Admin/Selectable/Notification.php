<?php

declare(strict_types=1);

namespace App\Admin\Selectable;

use Encore\Admin\Grid\Selectable;

class Notification extends Selectable
{
    public $model = \Modules\Notification\Models\Notification::class;

    public function make()
    {
        $this->column('id', '#');
        $this->column('name', '');
    }
}
