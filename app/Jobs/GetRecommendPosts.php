<?php
declare(strict_types=1);

namespace App\Jobs;

use Henry\Domain\Post\Repositories\PostRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class GetRecommendPosts
 * @package App\Jobs
 */
class GetRecommendPosts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * @param PostRepositoryInterface $postRepository
     * @return LengthAwarePaginator
     */
    public function handle(PostRepositoryInterface $postRepository): LengthAwarePaginator
    {
        $posts = $postRepository->getRecommendPosts();
        $posts->load('author');

        return $posts;
    }
}
