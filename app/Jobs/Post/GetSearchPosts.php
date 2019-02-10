<?php
declare(strict_types=1);

namespace App\Jobs\Post;

use Henry\Domain\Post\Repositories\PostRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class GetSearchPosts
 * @package App\Jobs\Post
 */
class GetSearchPosts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var string
     */
    private $keyword;
    /**
     * @var int
     */
    private $limit;

    /**
     * Create a new job instance.
     *
     * @param string $keyword
     * @param int $limit
     */
    public function __construct(string $keyword, int $limit = 10)
    {
        $this->keyword = $keyword;
        $this->limit = $limit;
    }

    /**
     * @param PostRepositoryInterface $postRepository
     * @return LengthAwarePaginator
     */
    public function handle(PostRepositoryInterface $postRepository): LengthAwarePaginator
    {
        $posts = $postRepository->getBySearch($this->keyword, $this->limit);
        $posts->load('author', 'relationTags', 'category');

        return $posts;
    }
}
