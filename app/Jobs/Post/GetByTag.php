<?php
declare(strict_types=1);

namespace App\Jobs\Post;

use Henry\Domain\Post\Repositories\PostRepositoryInterface;
use Henry\Domain\Tag\Tag;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class GetByTag
 * @package App\Jobs\Post
 */
class GetByTag implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Tag
     */
    private $tag;
    /**
     * @var int
     */
    private $limit;

    /**
     * Create a new job instance.
     * @param Tag $tag
     * @param int $limit
     */
    public function __construct(Tag $tag, int $limit = 20)
    {
        $this->tag = $tag;
        $this->limit = $limit;
    }

    /**
     * @param PostRepositoryInterface $postRepository
     * @return LengthAwarePaginator
     */
    public function handle(PostRepositoryInterface $postRepository): LengthAwarePaginator
    {
        $posts = $postRepository->getByTag($this->tag, $this->limit);
        $posts->load('author', 'category', 'relationTags', 'favoriteUsers');

        return $posts;
    }
}
