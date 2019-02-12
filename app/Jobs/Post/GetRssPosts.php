<?php
declare(strict_types=1);

namespace App\Jobs\Post;

use Henry\Domain\Post\Post;
use Henry\Domain\Post\Repositories\PostRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class GetRssPosts
 * @package App\Jobs\Post
 */
class GetRssPosts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var int
     */
    private $limit;

    /**
     * Create a new job instance.
     * @param int $limit
     */
    public function __construct(int $limit = 25)
    {
        $this->limit = $limit;
    }

    /**
     * @param PostRepositoryInterface $postRepository
     * @return LengthAwarePaginator
     */
    public function handle(PostRepositoryInterface $postRepository): LengthAwarePaginator
    {
        return $postRepository->withPaginate([
            'recommend' => Post::RECOMMEND,
            'active' => Post::PUBLISHED,
            'schedule_post' => ['operator' => '<=', time()],
            'orderBy' => 'created_at',
            'order' => 'desc'
        ], $this->limit);
    }
}
