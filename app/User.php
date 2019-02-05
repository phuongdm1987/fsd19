<?php
declare(strict_types=1);

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
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
     * Url to home page of user
     * @return string
     */
    public function getHomePageUrl(): string
    {
        return '/@' . $this->username;
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
}
