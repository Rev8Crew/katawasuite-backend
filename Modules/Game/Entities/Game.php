<?php

namespace Modules\Game\Entities;

use App\Enums\ActiveStatusEnum;
use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Modules\File\Entities\File;

class Game extends Model
{
    use ActiveScope;

    public const TABLE = 'games';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
        'height'
    ];

    protected $attributes = [
        'is_active' => ActiveStatusEnum::Active->value
    ];

    public function imageFile(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_id');
    }

    public function getImageAttribute(): ?string
    {
        $image = $this->image_id ? $this->imageFile->url : URL::to('storage/games/default.jpg');

        // Если не полный путь, значит это путь относительно диска
        if (!str_contains($image, 'http')) {
            $image = Storage::disk('admin')->url($image);
        }

        return $image;
    }

    public function getDirAttribute() : string {
        return 'games' . '/' . $this->short;
    }

    public function getIconHighAttribute() : string {
        return $this->getDirAttribute() . '/' . 'icon-high.png';
    }

    public function getThumbnailSmallAttribute() : string {
        return $this->getDirAttribute() . '/' . 'thumbnail.png';
    }

    public function getThumbnailHighAttribute() : string {
        return $this->getDirAttribute() . '/' . 'thumbnail-high.png';
    }

    public function getNameAttribute($value): string
    {
        return str_contains($value, ' (' . $this->restriction . '+)') ? $value : $value. ' (' . $this->restriction . '+)';
    }
}
