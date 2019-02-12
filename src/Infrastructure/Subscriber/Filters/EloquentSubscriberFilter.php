<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Subscriber\Filters;


use Henry\Domain\Subscriber\Filters\SubscriberFilterInterface;
use Henry\Infrastructure\AbstractEloquentFilter;

/**
 * Class EloquentSubscriberFilter
 * @package Henry\Infrastructure\Subscriber\Filters
 */
class EloquentSubscriberFilter extends AbstractEloquentFilter implements SubscriberFilterInterface
{
    protected $filters = [
        //
    ];
}
