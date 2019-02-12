<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Tag\Repositories;


use Henry\Domain\Tag\Tag;
use Henry\Domain\Tag\Filters\TagFilterInterface;
use Henry\Domain\Tag\Repositories\TagRepositoryInterface;
use Henry\Domain\Tag\Sorters\TagSorterInterface;
use Henry\Infrastructure\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class EloquentTagRepository
 * @package Henry\Infrastructure\Tag\Repositories
 */
class EloquentTagRepository extends AbstractEloquentRepository implements TagRepositoryInterface
{
    /**
     * AbstractEloquentRepository constructor.
     * @param \Henry\Domain\Tag\Tag $model
     * @param TagFilterInterface $filter
     * @param TagSorterInterface $sorter
     */
    public function __construct(Tag $model, TagFilterInterface $filter, TagSorterInterface $sorter)
    {
        parent::__construct($model, $filter, $sorter);
    }

    /**
     * @param int $count
     * @return Collection
     */
    public function getTagCountArticles($count = 20): Collection
    {
        return $this->model->join('post_tags', 'post_tags.tag_id', '=', 'tags.id')
            ->select(DB::raw('count( tag_id ) AS tag_count, tags.name, tags.slug'))
            ->groupBy('tag_id')
            ->orderBy('tag_count', 'DESC')
            ->take($count)->get();
    }
}
