<?php
declare(strict_types=1);

namespace App\Jobs\Post;

use App\Http\Requests\Post\UpdatePostRequest;
use Henry\Domain\Post\Post;
use Henry\Domain\Post\Repositories\PostRepositoryInterface;
use Henry\Support\Markdown;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class UpdatePost
 * @package App\Jobs\Post
 */
class UpdatePost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Post
     */
    private $post;
    /**
     * @var array
     */
    private $attributes;

    /**
     * Create a new job instance.
     * @param Post $post
     * @param array $attributes
     */
    public function __construct(Post $post, array $attributes = [])
    {
        $this->post = $post;
        $this->attributes = $attributes;
    }

    /**
     * @param Post $post
     * @param UpdatePostRequest $request
     * @return UpdatePost
     */
    public static function fromRequest(
        Post $post,
        UpdatePostRequest $request
    ): self {
        return new static($post, [
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
     * @return void
     */
    public function handle(Markdown $markdown, PostRepositoryInterface $postRepository): void
    {
        if ($this->post->active === 0 && $this->attributes['active'] === 1) {
            $this->attributes['created_at'] = now();
        }

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

        $postRepository->update($this->attributes, $this->post);

        SyncTags::dispatch($this->post, array_get($this->attributes, 'tags', ''));
    }
}
