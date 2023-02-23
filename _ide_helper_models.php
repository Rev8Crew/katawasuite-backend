<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace Modules\File\Entities{
/**
 * Modules\File\Entities\File
 *
 * @property-read \Modules\User\Entities\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File query()
 */
	class File extends \Eloquent {}
}

namespace Modules\Game\Entities{
/**
 * Modules\Game\Entities\Game
 *
 * @property-read string $dir
 * @property-read string $icon_high
 * @property-read string|null $image
 * @property-read string $name
 * @property-read string $thumbnail_high
 * @property-read string $thumbnail_small
 * @property-read \Modules\File\Entities\File|null $imageFile
 * @method static \Illuminate\Database\Eloquent\Builder|Game active()
 * @method static \Illuminate\Database\Eloquent\Builder|Game newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Game newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Game query()
 */
	class Game extends \Eloquent {}
}

namespace Modules\User\Entities{
/**
 * Modules\User\Entities\User
 *
 * @property int         $id
 * @property string      $name
 * @property string      $email
 * @property string      $password
 * @property Carbon|null $email_verified_at
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $phone
 * @property int $is_active
 * @property-read string $image
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Entities\UserSocial> $socials
 * @property-read int|null $socials_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace Modules\User\Entities{
/**
 * Modules\User\Entities\UserFavoritesGame
 *
 * @property-read \Modules\Game\Entities\Game|null $game
 * @property-read \Modules\User\Entities\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserFavoritesGame newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFavoritesGame newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFavoritesGame query()
 */
	class UserFavoritesGame extends \Eloquent {}
}

namespace Modules\User\Entities{
/**
 * Modules\User\Entities\UserGameSave
 *
 * @property-read \Modules\Game\Entities\Game|null $game
 * @property-read \Modules\User\Entities\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserGameSave newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGameSave newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGameSave query()
 */
	class UserGameSave extends \Eloquent {}
}

namespace Modules\User\Entities{
/**
 * Modules\User\Entities\UserSocial
 *
 * @property int $id
 * @property string $uuid
 * @property int|null $user_id
 * @property string $provider
 * @property string $provider_id
 * @property string|null $name Имя пользователя
 * @property string|null $avatar Аватар пользователя
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\User\Entities\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserSocial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSocial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSocial query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSocial whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSocial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSocial whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSocial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSocial whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSocial whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSocial whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSocial whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSocial whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSocial whereUuid($value)
 */
	class UserSocial extends \Eloquent {}
}

