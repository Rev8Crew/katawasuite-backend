<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class UserSocial extends Model
{

    /**
     * @var string
     */
    protected $table = 'user_socials';

    /**
     * @var array
     */
    protected $fillable = [
        'provider',
        'email',
        'name',
        'avatar',
    ];

    /**
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * @inheritDoc
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(static function($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
