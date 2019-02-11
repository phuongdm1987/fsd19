<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Post\Filters;


use Henry\Domain\Post\Filters\PostFilterInterface;
use Henry\Infrastructure\AbstractEloquentCommonFilter;

/**
 * Class EloquentUserIdFilter
 * @package Henry\Infrastructure\Post\Filters
 */
class EloquentUserIdFilter extends AbstractEloquentCommonFilter implements PostFilterInterface
{
    protected $searchField = 'user_id';
    protected $field = 'user_id';
}
