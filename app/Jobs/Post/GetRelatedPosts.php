<?php
declare(strict_types=1);

namespace App\Jobs\Post;

use Henry\Domain\Post\Post;
use Henry\Domain\Post\Repositories\PostRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class GetRelatedPosts
 * @package App\Jobs\Post
 */
class GetRelatedPosts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Post
     */
    private $post;
    /**
     * @var int
     */
    private $limit;

    /**
     * Create a new job instance.
     *
     * @param Post $post
     * @param int $limit
     */
    public function __construct(Post $post, int $limit = 5)
    {
        $this->post = $post;
        $this->limit = $limit;
    }

    /**
     * Execute the job.
     *
     * @param PostRepositoryInterface $postRepository
     * @return Collection
     */
    public function handle(PostRepositoryInterface $postRepository): Collection
    {
        $conditions = [
            'active' => Post::PUBLISHED,
            'schedule_post' => ['operator' => '<=', time()],
            'id' => explode(',', $this->post->related_post),
            'orderBy' => 'created_at',
            'order' => 'desc'
        ];

        $query = $postRepository->generateQueryBuilder($conditions);

        return $query->take($this->limit)->get();
    }
}
