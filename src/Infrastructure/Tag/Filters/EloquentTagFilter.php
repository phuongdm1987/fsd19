<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Tag\Filters;


use Henry\Domain\Tag\Filters\TagFilterInterface;
use Henry\Infrastructure\AbstractEloquentFilter;

/**
 * Class EloquentTagFilter
 * @package Henry\Infrastructure\Tag\Filters
 */
class EloquentTagFilter extends AbstractEloquentFilter implements TagFilterInterface
{
    protected $filters = [
        EloquentNameFilter::class
    ];
}
