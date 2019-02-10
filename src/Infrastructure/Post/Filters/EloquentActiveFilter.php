<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Post\Filters;


use Henry\Domain\Post\Filters\PostFilterInterface;
use Henry\Infrastructure\AbstractEloquentCommonFilter;

/**
 * Class EloquentActiveFilter
 * @package Henry\Infrastructure\Post\Filters
 */
class EloquentActiveFilter extends AbstractEloquentCommonFilter implements PostFilterInterface
{
    protected $searchField = 'active';
    protected $field = 'active';
}
