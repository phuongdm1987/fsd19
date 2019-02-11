<?php
declare(strict_types=1);

namespace Henry\Infrastructure\User\Filters;


use Henry\Domain\User\Filters\UserFilterInterface;
use Henry\Infrastructure\AbstractEloquentFilter;

/**
 * Class EloquentUserFilter
 * @package Henry\Infrastructure\User\Filters
 */
class EloquentUserFilter extends AbstractEloquentFilter implements UserFilterInterface
{

}
