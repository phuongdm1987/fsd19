<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Post\Filters;


use Henry\Domain\Post\Filters\PostFilterInterface;
use Henry\Infrastructure\AbstractEloquentNormalFilter;

/**
 * Class EloquentIdFilter
 * @package Henry\Infrastructure\Post\Filters
 */
class EloquentIdFilter extends AbstractEloquentNormalFilter implements PostFilterInterface
{
    protected $searchField = 'id';
    protected $field = 'id';
}
