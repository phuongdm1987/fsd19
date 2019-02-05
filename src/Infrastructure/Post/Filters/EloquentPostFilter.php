<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Post\Filters;


use Henry\Domain\Post\Filters\PostFilterInterface;
use Henry\Infrastructure\AbstractEloquentFilter;

/**
 * Class EloquentPostFilter
 * @package Henry\Infrastructure\Post\Filters
 */
class EloquentPostFilter extends AbstractEloquentFilter implements PostFilterInterface
{

}
