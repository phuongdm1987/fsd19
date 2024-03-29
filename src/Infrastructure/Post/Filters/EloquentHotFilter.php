<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Post\Filters;


use Henry\Domain\Post\Filters\PostFilterInterface;
use Henry\Infrastructure\AbstractEloquentCommonFilter;

/**
 * Class EloquentHotFilter
 * @package Henry\Infrastructure\Post\Filters
 */
class EloquentHotFilter extends AbstractEloquentCommonFilter implements PostFilterInterface
{
    protected $searchField = 'hot';
    protected $field = 'hot';
}
