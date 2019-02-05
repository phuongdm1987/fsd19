<?php
declare(strict_types=1);

namespace Henry\Domain\Category\Repositories;


use Henry\Domain\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface CategoryRepositoryInterface
 * @package Henry\Domain\Category\Repositories\
 */
interface CategoryRepositoryInterface extends RepositoryInterface
{
    /**
     * @return Collection
     */
    public function getParents(): Collection;
}
