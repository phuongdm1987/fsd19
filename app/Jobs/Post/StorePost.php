<?php
declare(strict_types=1);

namespace App\Jobs\Post;

use App\Http\Requests\Post\StorePostRequest;
use Henry\Domain\Post\Repositories\PostRepositoryInterface;
use Henry\Support\Markdown;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class StorePost
 * @package App\Jobs\Post
 */
class StorePost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var array
     */
    private $attributes;

    /**
     * Create a new job instance.
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @param StorePostRequest $request
     * @return self
     */
    public static function fromRequest(
        StorePostRequest $request
    ): self {
        return new static([
            'category_id' => $request->categoryId(),
            'title' => $request->title(),
            'content_markdown' => $request->content(),
            'active' => $request->active(),
            'tags' => $request->tags(),
            'related_post' => $request->relatedPosts(),
            'org_author' => $request->author(),
            'org_link' => $request->link(),
            'schedule_post' => $request->scheduleDate(),
        ]);
    }

    /**
     * Execute the job.
     * @param Markdown $markdown
     * @param PostRepositoryInterface $postRepository
     * @return Model
     */
    public function handle(Markdown $markdown, PostRepositoryInterface $postRepository): Model
    {
        $this->attributes['user_id'] = auth()->id();
        $contentMarkdown = array_get($this->attributes, 'content_markdown', '');
        $this->attributes['content'] = $markdown->convertMarkdownToHtml($contentMarkdown);
        $this->attributes['content'] = preg_replace('/(<pre>)/i', '<pre class="prettyprint">', $this->attributes['content']);

        $this->attributes['title'] = clean(array_get($this->attributes, 'title', ''));
        $this->attributes['slug'] = str_slug(array_get($this->attributes, 'title', ''));
        $this->attributes['related_post'] = clean(array_get($this->attributes, 'related_post', ''));
        $this->attributes['org_author'] = clean(array_get($this->attributes, 'org_author', ''));
        $this->attributes['org_link'] = clean(array_get($this->attributes, 'org_link', ''));
        $this->attributes['schedule_post'] = strtotime(array_get($this->attributes, 'schedule_post', ''));

        $this->attributes['thumbnail'] = ExtractAvatarInContent::dispatchNow(array_get($this->attributes, 'content', ''));

        $post = $postRepository->create($this->attributes);

        SyncTags::dispatch($post, array_get($this->attributes, 'tags', ''));

        return $post;
    }
}
