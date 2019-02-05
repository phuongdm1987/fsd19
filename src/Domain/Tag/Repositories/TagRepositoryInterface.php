<?php
declare(strict_types=1);

namespace Henry\Domain\Tag\Repositories;


use Henry\Domain\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface TagRepositoryInterface
 * @package Henry\Domain\Tag\Repositories\
 */
interface TagRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $count
     * @return Collection
     */
    public function getTagCountArticles($count = 20): Collection;
}
