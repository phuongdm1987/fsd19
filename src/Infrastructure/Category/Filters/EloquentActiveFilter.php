<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Category\Filters;


use Henry\Domain\Category\Filters\CategoryFilterInterface;
use Henry\Infrastructure\AbstractEloquentNormalFilter;

/**
 * Class EloquentActiveFilter
 * @package Henry\Infrastructure\Category\Filters
 */
class EloquentActiveFilter extends AbstractEloquentNormalFilter implements CategoryFilterInterface
{
    protected $searchField = 'active';
    protected $field = 'active';
}
