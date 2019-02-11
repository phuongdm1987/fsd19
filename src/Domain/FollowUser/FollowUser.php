<?php
declare(strict_types=1);

namespace Henry\Domain\FollowUser;

use Henry\Domain\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class FollowUser
 * @package Henry\Domain\FollowUser
 */
class FollowUser extends Model
{
    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * @return BelongsTo
     */
    public function friend(): BelongsTo
    {
        return $this->belongsTo(User::class, 'friend_id');
    }
}
