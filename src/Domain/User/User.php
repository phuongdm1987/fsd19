<?php
declare(strict_types=1);

namespace Henry\Domain\User;

use Henry\Domain\FollowUser\FollowUser;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package Henry\Domain\User
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'username';
    }

    /**
     * Url to home page of user
     * @return string
     */
    public function getHomePageUrl(): string
    {
        return route('users.show', $this->username);
    }

    /**
     * Returns the user Gravatar image url.
     *
     * @return string
     */
    public function gravatar(): string
    {
        // Generate the Gravatar hash
        $gravatar = md5(strtolower(trim((string)$this->gravatar)));

        // Return the Gravatar url
        return "//gravatar.org/avatar/{$gravatar}";
    }

    /**
     * Return the user cover image url
     * @return string
     */
    public function getCover(): string
    {
        return $this->cover ?? '/img/fsd14.com.jpg';
    }

    /**
     * Returns the user full name, it simply concatenates
     * the user first and last name.
     *
     * @return string
     */
    public function nickName(): string
    {
        return $this->nickname;
    }

    /**
     * @return HasMany
     */
    public function followers(): HasMany
    {
        return $this->hasMany(FollowUser::class, 'friend_id');
    }

    /**
     * @return HasMany
     */
    public function followings(): HasMany
    {
        return $this->hasMany(FollowUser::class, 'user_id');
    }
}
