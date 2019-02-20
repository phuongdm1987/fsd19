<?php
declare(strict_types=1);

namespace Henry\Domain\Post;

use Henry\Domain\User\User;
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

    protected $fillable = ['user_id', 'title', 'slug', 'content', 'content_markdown', 'thumbnail', 'active', 'category_id', 'tags', 'schedule_post', 'related_post', 'org_author', 'org_link'];

    /**
     * Return publish time of the article
     * @return string
     */
    public function publishTimes(): string
    {
        return $this->created_at->format('H:i - d/m/Y');
    }

    /**
     * @return string
     */
    public static function getThumbnailUploadPath(): string
    {
        return public_path('images/');
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
     * Return the post thumbnail image url.
     * @param string $type
     * @return string
     */
    public function thumbnail($type = ''): string
    {
        return $this->thumbnail !== ''
            ? '/images/' . $type . $this->thumbnail
            : '/img/150x150.gif';
    }

    /**
     * Return list tag with their link
     * @return string
     */
    public function getTags(): string
    {
        $tag_list = [];

        foreach ($this->relationTags as $tag) {
            $url = route('tags.show', $tag->slug);
            $tag_list[] = '<a href="' . $url .'" title="' . $tag->name . '">' . $tag->name . '</a>';
        }

        return implode(' ', $tag_list);
    }

    /**
     * @return bool
     */
    public function isFavorite(): bool
    {
        if (!auth()->check()) {
            return false;
        }

        return $this->favoriteUsers->contains('id', auth()->id());
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
    public function favoriteUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'recommend_posts', 'post_id', 'user_id');
    }

    /**
     * @return BelongsToMany
     */
    public function relationTags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }
}
