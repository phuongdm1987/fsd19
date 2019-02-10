<?php
declare(strict_types=1);

namespace Henry\Domain\Post\Repositories;


use Henry\Domain\Category\Category;
use Henry\Domain\Post\Post;
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
     * @param Category|null $category
     * @return Collection
     */
    public function getTopPosts(Category $category = null): Collection;

    /**
     * @param string $keyword
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getBySearch(string $keyword, int $limit = 10): LengthAwarePaginator;
}
