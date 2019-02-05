<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Post\Repositories;


use Henry\Domain\Post\Post;
use Henry\Domain\Post\Filters\PostFilterInterface;
use Henry\Domain\Post\Repositories\PostRepositoryInterface;
use Henry\Domain\Post\Sorters\PostSorterInterface;
use Henry\Domain\Post\ValueObjects\Type;
use Henry\Infrastructure\AbstractEloquentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class EloquentPostRepository
 * @package Henry\Infrastructure\Post\Repositories
 */
class EloquentPostRepository extends AbstractEloquentRepository implements PostRepositoryInterface
{
    /**
     * AbstractEloquentRepository constructor.
     * @param \Henry\Domain\Post\Post $model
     * @param PostFilterInterface $filter
     * @param PostSorterInterface $sorter
     */
    public function __construct(Post $model, PostFilterInterface $filter, PostSorterInterface $sorter)
    {
        parent::__construct($model, $filter, $sorter);
    }

    /**
     * @param int $count
     * @return Collection
     */
    public function getPostCountArticles($count = 20): Collection
    {
        return $this->model->join('post_tags', 'post_tags.tag_id', '=', 'tags.id')
            ->select(DB::raw('count( tag_id ) AS tag_count, tags.name, tags.slug'))
            ->groupBy('tag_id')
            ->orderBy('tag_count', 'DESC')
            ->take($count)->get();
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getRecommendPosts(int $perPage = 10): LengthAwarePaginator
    {
        return $this->withPaginate([
            'recommend' => Post::RECOMMEND,
            'active' => Post::PUBLISHED,
            'schedule_post' => ['operator' => '<=', time()],
            'orderBy' => 'created_at',
            'order' => 'desc'
        ], $perPage);
    }
}
