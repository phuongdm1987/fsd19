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
 * Class GetByCategory
 * @package App\Jobs\Post
 */
class GetByCategory implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var array
     */
    private $categoryIds;
    /**
     * @var int
     */
    private $limit;

    /**
     * GetByCategory constructor.
     * @param array $categoryIds
     * @param int $limit
     */
    public function __construct(array $categoryIds = [], $limit = 10)
    {
        $this->categoryIds = $categoryIds;
        $this->limit = $limit;
    }

    /**
     * @param PostRepositoryInterface $postRepository
     * @return LengthAwarePaginator
     */
    public function handle(PostRepositoryInterface $postRepository): LengthAwarePaginator
    {
        return $postRepository->withPaginate([
            'category_id' => $this->categoryIds
        ], $this->limit);
    }
}
