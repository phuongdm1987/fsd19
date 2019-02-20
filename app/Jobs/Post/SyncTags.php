<?php
declare(strict_types=1);

namespace App\Jobs\Post;

use Henry\Domain\Post\Post;
use Henry\Domain\Tag\Repositories\TagRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class SyncTags
 * @package App\Jobs\Post
 */
class SyncTags implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Post
     */
    private $post;
    /**
     * @var string
     */
    private $stringTagNames;

    /**
     * Create a new job instance.
     * @param Post $post
     * @param string $stringTagNames
     */
    public function __construct(Post $post, string $stringTagNames)
    {
        $this->post = $post;
        $this->stringTagNames = $stringTagNames;
    }

    /**
     * Execute the job.
     * @param TagRepositoryInterface $tagRepository
     * @return void
     */
    public function handle(TagRepositoryInterface $tagRepository): void
    {
        $tagNames = explode(',', $this->stringTagNames);

        $tags = $tagRepository->all([
            'name' => $tagNames
        ]);

        $this->post->relationTags()->sync($tags->pluck('id')->toArray());
    }
}
