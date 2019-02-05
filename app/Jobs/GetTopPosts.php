<?php
declare(strict_types=1);

namespace App\Jobs;

use Henry\Domain\Post\Repositories\PostRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class GetTopPosts
 * @package App\Jobs
 */
class GetTopPosts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @param PostRepositoryInterface $postRepository
     * @return Collection
     */
    public function handle(PostRepositoryInterface $postRepository): Collection
    {
        $posts = $postRepository->getTopPosts();
        $posts->load('category');

        return $posts;
    }
}
