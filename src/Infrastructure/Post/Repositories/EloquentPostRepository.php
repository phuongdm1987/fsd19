<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Post\Repositories;


use Henry\Domain\Category\Category;
use Henry\Domain\Post\Post;
use Henry\Domain\Post\Filters\PostFilterInterface;
use Henry\Domain\Post\Repositories\PostRepositoryInterface;
use Henry\Domain\Post\Sorters\PostSorterInterface;
use Henry\Domain\Tag\Tag;
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
     * @param Category|null $category
     * @return Collection
     */
    public function getTopPosts(Category $category = null): Collection
    {
        $conditions = [
            'active' => Post::PUBLISHED,
            'hot' => 1,
            'schedule_post' => ['operator' => '<=', time()],
            'orderBy' => 'created_at',
            'order' => 'desc'
        ];

        if ($category) {
            $conditions['category_id'] =$category->id;
        }

        $query = $this->generateQueryBuilder($conditions);

        return $query->take(5)->get();
    }

    /**
     * @param string $keyword
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getBySearch(string $keyword, int $limit = 10): LengthAwarePaginator
    {
        return $this->model
            ->where('schedule_post', '<=', time())
            ->where('active', 1)
            ->where(function ($query) use ($keyword) {
                $query->where('tags', 'like', "%{$keyword}%")
                    ->orWhere('slug', 'like', "%{$keyword}%");
            })
            ->orderByDesc('created_at')
            ->paginate($limit);
    }

    /**
     * @param Tag $tag
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getByTag(Tag $tag, int $limit = 20): LengthAwarePaginator
    {
        return $this->model
            ->where('schedule_post', '<=', time())
            ->where('active', 1)
            ->whereHas('relationTags', function ($query) use ($tag) {
                $query->where('slug', $tag->getSlug());
            })
            ->orderByDesc('created_at')
            ->paginate($limit);
    }
}
