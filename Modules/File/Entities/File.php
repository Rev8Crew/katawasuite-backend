<?php

namespace Modules\File\Entities;

use App\Enums\ActiveStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\User\Entities\User;

class File extends Model
{
    public const TABLE = 'files';

    protected $fillable = [
        'path',
        'url',
        'name',
        'mime',
        'is_active',
    ];

    protected $attributes = [
        'is_active' => ActiveStatusEnum::Active->value
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
