<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Subscriber\Sorters;


use Henry\Domain\Subscriber\Sorters\SubscriberSorterInterface;
use Henry\Infrastructure\AbstractEloquentSorter;

/**
 * Class EloquentSubscriberSorter
 * @package Henry\Infrastructure\Subscriber\Sorters
 */
class EloquentSubscriberSorter extends AbstractEloquentSorter implements SubscriberSorterInterface
{
    /**
     * @var array
     */
    protected $fields = [];
}
