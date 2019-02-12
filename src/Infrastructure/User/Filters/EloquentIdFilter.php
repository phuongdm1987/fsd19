<?php
declare(strict_types=1);

namespace Henry\Infrastructure\User\Filters;


use Henry\Domain\User\Filters\UserFilterInterface;
use Henry\Infrastructure\AbstractEloquentCommonFilter;

/**
 * Class EloquentIdFilter
 * @package Henry\Infrastructure\Post\Filters
 */
class EloquentIdFilter extends AbstractEloquentCommonFilter implements UserFilterInterface
{
    protected $searchField = 'id';
    protected $field = 'id';
}
