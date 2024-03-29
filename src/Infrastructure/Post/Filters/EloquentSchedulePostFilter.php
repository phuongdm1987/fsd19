<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Post\Filters;


use Henry\Domain\Post\Filters\PostFilterInterface;
use Henry\Infrastructure\AbstractEloquentCommonFilter;

/**
 * Class EloquentSchedulePostFilter
 * @package Henry\Infrastructure\Post\Filters
 */
class EloquentSchedulePostFilter extends AbstractEloquentCommonFilter implements PostFilterInterface
{
    protected $searchField = 'schedule_post';
    protected $field = 'schedule_post';
}
