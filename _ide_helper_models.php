<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace Modules\Achievement\Models{
/**
 * Modules\Achievement\Models\Achievement
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $short
 * @property int|null $game_id
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Game\Entities\Game|null $game
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Achievement\Models\AchievementReward> $rewards
 * @property-read int|null $rewards_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Entities\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement active()
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereUpdatedAt($value)
 */
	class Achievement extends \Eloquent {}
}

namespace Modules\Achievement\Models{
/**
 * Modules\Achievement\Models\AchievementReward
 *
 * @property int $id
 * @property string $type
 * @property string|null $value
 * @property int $is_active
 * @property int $achievement_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Achievement\Models\Achievement $achievement
 * @method static \Illuminate\Database\Eloquent\Builder|AchievementReward newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AchievementReward newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AchievementReward query()
 * @method static \Illuminate\Database\Eloquent\Builder|AchievementReward whereAchievementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AchievementReward whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AchievementReward whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AchievementReward whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AchievementReward whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AchievementReward whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AchievementReward whereValue($value)
 */
	class AchievementReward extends \Eloquent {}
}

namespace Modules\Feedback\Entities{
/**
 * Modules\Feedback\Entities\Feedback
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $text
 * @property string $relation
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\User\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback query()
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereRelation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereUserId($value)
 */
	class Feedback extends \Eloquent {}
}

namespace Modules\File\Entities{
/**
 * Modules\File\Entities\File
 *
 * @property int $id
 * @property string|null $path
 * @property string|null $url
 * @property string|null $name
 * @property string|null $mime
 * @property int $is_active
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\User\Entities\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File query()
 * @method static \Illuminate\Database\Eloquent\Builder|File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereMime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUserId($value)
 */
	class File extends \Eloquent {}
}

namespace Modules\Game\Entities{
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
 * @property-read \Modules\File\Entities\File|null $imageFile
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
 */
	class Game extends \Eloquent {}
}

namespace Modules\Notifications\Models{
/**
 * Modules\Notifications\Models\Notification
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Entities\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 */
	class Notification extends \Eloquent {}
}

namespace Modules\Notifications\Models{
/**
 * Modules\Notifications\Models\NotificationDelivery
 *
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationDelivery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationDelivery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationDelivery query()
 */
	class NotificationDelivery extends \Eloquent {}
}

namespace Modules\Notifications\Models{
/**
 * Modules\Notifications\Models\NotificationRelease
 *
 * @property-read \Modules\Notifications\Models\Notification|null $notification
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\User\Entities\User> $notificationDelivery
 * @property-read int|null $notification_delivery_count
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationRelease newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationRelease newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotificationRelease query()
 */
	class NotificationRelease extends \Eloquent {}
}

namespace Modules\Statistic\Models{
/**
 * Modules\Statistic\Models\TimeTracker
 *
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property int $start
 * @property int $end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Game\Entities\Game $game
 * @property-read \Modules\User\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|TimeTracker newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TimeTracker newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TimeTracker query()
 * @method static \Illuminate\Database\Eloquent\Builder|TimeTracker whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimeTracker whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimeTracker whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimeTracker whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimeTracker whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimeTracker whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimeTracker whereUserId($value)
 */
	class TimeTracker extends \Eloquent {}
}

namespace Modules\Statistic\Models{
/**
 * Modules\Statistic\Models\UserStatistic
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $game_id
 * @property string $option
 * @property string|null $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\User\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserStatistic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserStatistic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserStatistic query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserStatistic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStatistic whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStatistic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStatistic whereOption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStatistic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStatistic whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserStatistic whereValue($value)
 */
	class UserStatistic extends \Eloquent {}
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Achievement\Models\Achievement> $achievements
 * @property-read int|null $achievements_count
 * @property-read string $image
 * @property-read \Modules\File\Entities\File|null $imageFile
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
 * Modules\User\Entities\UserFavoriteGames
 *
 * @property int $id
 * @property int $user_id
 * @property int $game_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Game\Entities\Game $game
 * @property-read \Modules\User\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserFavoriteGames newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFavoriteGames newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFavoriteGames query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFavoriteGames whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFavoriteGames whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFavoriteGames whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFavoriteGames whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFavoriteGames whereUserId($value)
 */
	class UserFavoriteGames extends \Eloquent {}
}

namespace Modules\User\Entities{
/**
 * Modules\User\Entities\UserGameSave
 *
 * @property int $id
 * @property array|null $data
 * @property int|null $slot
 * @property int $user_id
 * @property int $game_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Game\Entities\Game $game
 * @property-read \Modules\User\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserGameSave newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGameSave newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGameSave query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGameSave whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGameSave whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGameSave whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGameSave whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGameSave whereSlot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGameSave whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGameSave whereUserId($value)
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

