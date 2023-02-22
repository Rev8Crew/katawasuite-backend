<?php

namespace Modules\User\Entities;

use App\Enums\ActiveStatusEnum;
use App\Helpers\ImageHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int         $id
 * @property string      $name
 * @property string      $email
 * @property string      $password
 * @property Carbon|null $email_verified_at
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'is_active',
        'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $attributes = [
        'is_active' => ActiveStatusEnum::Active->value
    ];

    /**
     * Return URL of the image
     * @return string
     */
    public function getImageAttribute() : string {
        $image = null;

        if (
            !$image &&
            $this->socials->count() === 1 &&
            $this->socials->first()->avatar !== null
        ) {
            $image = $this->socials->first()->avatar;
        }

        return $image ?? ImageHelper::getAvatarImage($this->name);
    }

    public function socials(): HasMany
    {
        return $this->hasMany(UserSocial::class, 'user_id', 'id');
    }
}
