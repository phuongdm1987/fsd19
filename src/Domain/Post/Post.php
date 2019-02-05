<?php
declare(strict_types=1);

namespace Henry\Domain\Post;

use App\User;
use Henry\Domain\Category\Category;
use Henry\Domain\Tag\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Post
 * @package Henry\Domain\Post
 */
class Post extends Model
{
    public const DRAFT = 0;
    public const PUBLISHED = 1;

    public const RECOMMEND = 1;
    public const UNRECOMMENDED = 0;



    /**
     * Return publish time of the article
     * @return string
     */
    public function publishTimes(): string
    {
        return $this->created_at->format('H:i - d/m/Y');
    }

    /**
     * Return the post's url
     * @return string
     */
    public function url(): string
    {
        return route('posts.show', [$this->id, $this->slug]);
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id');
    }
}
