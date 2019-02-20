<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Tag\Filters;


use Henry\Domain\Post\Filters\PostFilterInterface;
use Henry\Infrastructure\AbstractEloquentCommonFilter;

/**
 * Class EloquentNameFilter
 * @package Henry\Infrastructure\Tag\Filters
 */
class EloquentNameFilter extends AbstractEloquentCommonFilter implements PostFilterInterface
{
    protected $searchField = 'name';
    protected $field = 'name';
}
