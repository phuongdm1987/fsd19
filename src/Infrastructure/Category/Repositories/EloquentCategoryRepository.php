<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Category\Repositories;


use Henry\Domain\Category\Category;
use Henry\Domain\Category\Filters\CategoryFilterInterface;
use Henry\Domain\Category\Repositories\CategoryRepositoryInterface;
use Henry\Domain\Category\Sorters\CategorySorterInterface;
use Henry\Infrastructure\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\DB;

/**
 * Class EloquentCategoryRepository
 * @package Henry\Infrastructure\Category\Repositories
 */
class EloquentCategoryRepository extends AbstractEloquentRepository implements CategoryRepositoryInterface
{
    /**
     * AbstractEloquentRepository constructor.
     * @param \Henry\Domain\Category\Category $model
     * @param CategoryFilterInterface $filter
     * @param CategorySorterInterface $sorter
     */
    public function __construct(Category $model, CategoryFilterInterface $filter, CategorySorterInterface $sorter)
    {
        parent::__construct($model, $filter, $sorter);
    }

    /**
     * @param int $count
     * @return Collection
     */
    public function getCategoryCountArticles($count = 20): Collection
    {
        return $this->model->join('post_tags', 'post_tags.tag_id', '=', 'tags.id')
            ->select(DB::raw('count( tag_id ) AS tag_count, tags.name, tags.slug'))
            ->groupBy('tag_id')
            ->orderBy('tag_count', 'DESC')
            ->take($count)->get();
    }

    /**
     * @return Collection
     */
    public function getParents(): Collection
    {
        return $this->all([
            'parent_id' => 0,
            'active' => 1,
            'orderBy' => 'name',
            'order' => 'asc'
        ]);
    }

    /**
     * @param int $currentId
     * @param string $symbol
     * @param SupportCollection|null $categories
     * @param string $html
     * @param int $level
     * @return string
     */
    public function generateSelectBox(
        int $currentId = 0,
        string $symbol = '&rarr;',
        SupportCollection $categories = null,
        string &$html = '',
        int &$level = 0
    ): string
    {
        $strLevel = '';
        for ($i = 0; $i < $level; $i++) {
            $strLevel .= $symbol;
        }

        if ($categories === null) {
            $categories = $this->model->where('parents', 0)->get();
        }

        foreach ($categories as $category) {
            $isSelected = $category->id === $currentId ? 'selected="true"' : '';
            $html .= '<option name="category_id" value="' . $category->id . '"' . $isSelected . '>' . $strLevel . $category->name . '</option>';
            if ($category->children) {
                ++$level;
                $this->generateSelectBox($currentId, $symbol, $category->children, $html, $level);
            }
        }

        --$level;

        return $html;
    }
}
