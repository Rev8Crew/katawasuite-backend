<?php

namespace Modules\Game\Entities;

use App\Enums\ActiveStatusEnum;
use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Modules\File\Entities\File;

/**
 * Modules\Game\Entities\Game
 *
 * @property int $id
 * @property int $parent_id
 * @property string|null $description
 * @property string|null $short_description
 * @property string $name
 * @property string $short
 * @property string|null $width
 * @property string|null $height
 * @property int $is_active
 * @property int|null $image_id
 * @property int|null $restriction
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $dir
 * @property-read string $icon_high
 * @property-read string|null $image
 * @property-read string $thumbnail_high
 * @property-read string $thumbnail_small
 * @property-read File|null $imageFile
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Game active()
 * @method static \Illuminate\Database\Eloquent\Builder|Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Game query()
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereRestriction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Game whereWidth($value)
 *
 * @mixin \Eloquent
 */
class Game extends Model
{
    use ActiveScope;

    public const TABLE = 'games';

    protected $table = self::TABLE;

    protected $fillable = [
        'name',
        'short',
        'is_active',
        'description',
        'short_description',
        'restriction',
        'parent_id',
        'image_id',
        'width',
        'height',
    ];

    protected $attributes = [
        'is_active' => ActiveStatusEnum::Active->value,
    ];

    public function imageFile(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_id');
    }

    public function getImageAttribute(): ?string
    {
        $image = $this->image_id ? $this->imageFile->url : URL::to('storage/games/default.jpg');

        // Если не полный путь, значит это путь относительно диска
        if (! str_contains($image, 'http')) {
            $image = Storage::disk('admin')->url($image);
        }

        return $image;
    }

    public function getDirAttribute(): string
    {
        return 'games'.'/'.$this->short;
    }

    public function getIconHighAttribute(): string
    {
        return $this->getDirAttribute().'/'.'icon-high.png';
    }

    public function getThumbnailSmallAttribute(): string
    {
        return $this->getDirAttribute().'/'.'thumbnail.png';
    }

    public function getThumbnailHighAttribute(): string
    {
        return $this->getDirAttribute().'/'.'thumbnail-high.png';
    }

    public function getNameAttribute($value): string
    {
        return str_contains($value, ' ('.$this->restriction.'+)') ? $value : $value.' ('.$this->restriction.'+)';
    }
}
