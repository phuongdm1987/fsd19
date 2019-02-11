<?php
declare(strict_types=1);

namespace Henry\Infrastructure\User\Repositories;


use Henry\Domain\User\Filters\UserFilterInterface;
use Henry\Domain\User\Repositories\UserRepositoryInterface;
use Henry\Domain\User\Sorters\UserSorterInterface;
use Henry\Domain\User\User;
use Henry\Infrastructure\AbstractEloquentRepository;

/**
 * Class EloquentUserRepository
 * @package Henry\Infrastructure\User\Repositories
 */
class EloquentUserRepository extends AbstractEloquentRepository implements UserRepositoryInterface
{
    /**
     * AbstractEloquentRepository constructor.
     * @param \Henry\Domain\User\User $model
     * @param UserFilterInterface $filter
     * @param UserSorterInterface $sorter
     */
    public function __construct(User $model, UserFilterInterface $filter, UserSorterInterface $sorter)
    {
        parent::__construct($model, $filter, $sorter);
    }
}
