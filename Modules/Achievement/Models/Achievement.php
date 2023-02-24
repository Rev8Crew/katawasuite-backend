<?php

namespace Modules\Achievement\Models;

use App\Enums\ActiveStatusEnum;
use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Game\Entities\Game;
use Modules\User\Entities\User;

class Achievement extends Model
{
    use ActiveScope;

    public const TABLE = 'achievements';

    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'description',
        'is_active',
        'game_id',
        'short',
    ];

    protected $attributes = [
        'is_active' => ActiveStatusEnum::Active->value,
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'achievement_user')->withTimestamps();
    }

    public function rewards(): HasMany
    {
        return $this->hasMany(AchievementReward::class);
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
