<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Post\Filters;


use Henry\Domain\Post\Filters\PostFilterInterface;
use Henry\Infrastructure\AbstractEloquentNormalFilter;

/**
 * Class EloquentRecommendFilter
 * @package Henry\Infrastructure\Post\Filters
 */
class EloquentRecommendFilter extends AbstractEloquentNormalFilter implements PostFilterInterface
{
    protected $searchField = 'id';
    protected $field = 'id';
}
