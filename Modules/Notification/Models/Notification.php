<?php

namespace Modules\Notification\Models;

use App\Enums\ActiveStatusEnum;
use App\Scopes\ActiveScope;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Modules\Game\Entities\Game;
use Modules\User\Entities\User;

/**
 * Modules\Notification\Models\Notification
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $short
 * @property string $code
 * @property int $is_active
 * @property string $entity_class
 * @property int $entity_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, User> $users
 * @property-read int|null $users_count
 *
 * @method static Builder|Notification active()
 * @method static Builder|Notification newModelQuery()
 * @method static Builder|Notification newQuery()
 * @method static Builder|Notification query()
 * @method static Builder|Notification whereCode($value)
 * @method static Builder|Notification whereCreatedAt($value)
 * @method static Builder|Notification whereDescription($value)
 * @method static Builder|Notification whereId($value)
 * @method static Builder|Notification whereIsActive($value)
 * @method static Builder|Notification whereName($value)
 * @method static Builder|Notification whereShort($value)
 * @method static Builder|Notification whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Notification extends Model
{
    use ActiveScope;

    public const TABLE = 'notifications';

    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'short',
        'description',
        'code',
        'entity_class',
        'entity_id'
    ];

    protected $attributes = [
        'is_active' => ActiveStatusEnum::Active
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function games(): HasOne
    {
        return $this->hasOne(Game::class, 'id', 'entity_id');
    }
}
