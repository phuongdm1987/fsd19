<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Category\Filters;


use Henry\Domain\Category\Filters\CategoryFilterInterface;
use Henry\Infrastructure\AbstractEloquentCommonFilter;

/**
 * Class EloquentParentIdFilter
 * @package Henry\Infrastructure\Category\Filters
 */
class EloquentParentIdFilter extends AbstractEloquentCommonFilter implements CategoryFilterInterface
{
    protected $searchField = 'parent_id';
    protected $field = 'parents';

    /**
     * @param $queryParam
     * @return mixed
     */
    protected function assertTrue($queryParam)
    {
        parent::assertTrue($queryParam); // TODO: Change the autogenerated stub
        return $queryParam >= 0;
    }
}