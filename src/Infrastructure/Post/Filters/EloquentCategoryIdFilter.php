<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Post\Filters;


use Henry\Domain\Post\Filters\PostFilterInterface;
use Henry\Infrastructure\AbstractEloquentNormalFilter;

/**
 * Class EloquentCategoryIdFilter
 * @package Henry\Infrastructure\Post\Filters
 */
class EloquentCategoryIdFilter extends AbstractEloquentNormalFilter implements PostFilterInterface
{
    protected $searchField = 'category_id';
    protected $field = 'category_id';
}
