<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Post\Filters;


use Henry\Domain\Post\Filters\PostFilterInterface;
use Henry\Infrastructure\AbstractEloquentCommonFilter;

/**
 * Class EloquentNameFilter
 * @package Henry\Infrastructure\Post\Filters
 */
class EloquentIdFilter extends AbstractEloquentCommonFilter implements PostFilterInterface
{
    protected $searchField = 'id';
    protected $field = 'id';
}
