<?php
declare(strict_types=1);

namespace App\Jobs\Post;

use App\Http\Requests\Post\UpdatePostRequest;
use Henry\Domain\Post\Post;
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
        //
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
            'title' => $request->title(),
            'content_markdown' => $request->content(),
            'active' => $request->active(),
            'tags' => $request->tags()
        ]);
    }

    /**
     * Execute the job.
     * @param Markdown $markdown
     * @return void
     */
    public function handle(Markdown $markdown): void
    {
        $contentMarkdown = array_get($this->attributes, 'content_markdown', '');
        $this->attributes['content'] = $markdown->convertMarkdownToHtml($contentMarkdown);
        $this->attributes['content'] = preg_replace('/(<pre>)/i', '<pre class="prettyprint">', $this->attributes['content']);

        $this->attributes['title'] = clean(array_get($this->attributes, 'title', ''));
        $this->attributes['slug'] = str_slug($this->attributes['title']);

        //		$this->post->tags       = Xss::clean($request->get("post_tags"));
        $this->post->related_post     = clean($request->get("addition_links"));
        $this->post->org_author       = clean($request->get("author"));
        $this->post->org_link         = clean($request->get("link"));
        $this->post->schedule_post    = strtotime($request->get('date-timer'));

        if ($active == 0 && $request->get('post_active') == 1) {
            $this->post->created_at  = now();
        }

        $this->post->updated_at = now();
        $this->post->thumbnail = $this->extractPostAvatar($rendered_content);
        $this->post->save();

        $this->mArticle->savePostTags($this->post, $request->get('post_tags'));
    }
}
