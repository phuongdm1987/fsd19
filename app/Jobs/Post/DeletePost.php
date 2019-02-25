<?php
declare(strict_types=1);

namespace App\Jobs\Post;

use Henry\Domain\Post\Post;
use Henry\Domain\Post\Repositories\PostRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class DeletePost
 * @package App\Jobs\Post
 */
class DeletePost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Post
     */
    private $post;

    /**
     * Create a new job instance.
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @param PostRepositoryInterface $postRepository
     * @throws \Exception
     */
    public function handle(PostRepositoryInterface $postRepository): void
    {
        SyncTags::dispatch($this->post, '');
        $postRepository->delete($this->post);
    }
}
