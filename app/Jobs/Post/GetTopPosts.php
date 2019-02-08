<?php
declare(strict_types=1);

namespace App\Jobs\Post;

use Henry\Domain\Category\Category;
use Henry\Domain\Post\Repositories\PostRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class GetTopPosts
 * @package App\Jobs\Post
 */
class GetTopPosts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Category|null
     */
    private $category;

    /**
     * Create a new job instance.
     *
     * @param Category|null $category
     */
    public function __construct(Category $category = null)
    {
        $this->category = $category;
    }

    /**
     * Execute the job.
     *
     * @param PostRepositoryInterface $postRepository
     * @return Collection
     */
    public function handle(PostRepositoryInterface $postRepository): Collection
    {
        $posts = $postRepository->getTopPosts($this->category);
        $posts->load('category');

        return $posts;
    }
}
