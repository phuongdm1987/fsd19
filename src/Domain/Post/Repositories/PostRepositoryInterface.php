<?php
declare(strict_types=1);

namespace Henry\Domain\Post\Repositories;


use Henry\Domain\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface PostRepositoryInterface
 * @package Henry\Domain\Post\Repositories
 */
interface PostRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getRecommendPosts(int $perPage = 10): LengthAwarePaginator;

    /**
     * @return Collection
     */
    public function getTopPosts(): Collection;
}
