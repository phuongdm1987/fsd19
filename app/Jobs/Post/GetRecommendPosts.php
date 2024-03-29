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
 * Class GetRecommendPosts
 * @package App\Jobs\Post
 */
class GetRecommendPosts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var int
     */
    private $perPage;

    /**
     * GetRecommendPosts constructor.
     * @param int $perPage
     */
    public function __construct(int $perPage = 10)
    {
        $this->perPage = $perPage;
    }

    /**
     * @param PostRepositoryInterface $postRepository
     * @return LengthAwarePaginator
     */
    public function handle(PostRepositoryInterface $postRepository): LengthAwarePaginator
    {
        $posts = $postRepository->withPaginate([
            'recommend' => Post::RECOMMEND,
            'active' => Post::PUBLISHED,
            'schedule_post' => ['operator' => '<=', time()],
            'orderBy' => 'created_at',
            'order' => 'desc'
        ], $this->perPage);

        $posts->load('author', 'category', 'relationTags', 'favoriteUsers');

        return $posts;
    }
}
