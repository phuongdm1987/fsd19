<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Post\Filters;


use Henry\Domain\Post\Filters\PostFilterInterface;
use Henry\Infrastructure\AbstractEloquentCommonFilter;

/**
 * Class EloquentRecommendFilter
 * @package Henry\Infrastructure\Post\Filters
 */
class EloquentRecommendFilter extends AbstractEloquentCommonFilter implements PostFilterInterface
{
    protected $searchField = 'recommend';
    protected $field = 'recommend';
}
