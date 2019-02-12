<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Subscriber\Repositories;


use Henry\Domain\Subscriber\Filters\SubscriberFilterInterface;
use Henry\Domain\Subscriber\Repositories\SubscriberRepositoryInterface;
use Henry\Domain\Subscriber\Sorters\SubscriberSorterInterface;
use Henry\Domain\Subscriber\Subscriber;
use Henry\Infrastructure\AbstractEloquentRepository;

/**
 * Class EloquentSubscriberRepository
 * @package Henry\Infrastructure\Subscriber\Repositories
 */
class EloquentSubscriberRepository extends AbstractEloquentRepository implements SubscriberRepositoryInterface
{
    /**
     * AbstractEloquentRepository constructor.
     * @param \Henry\Domain\Subscriber\Subscriber $model
     * @param SubscriberFilterInterface $filter
     * @param SubscriberSorterInterface $sorter
     */
    public function __construct(Subscriber $model, SubscriberFilterInterface $filter, SubscriberSorterInterface $sorter)
    {
        parent::__construct($model, $filter, $sorter);
    }
}
