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
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getRecommendPosts(int $perPage = 10): LengthAwarePaginator;

    /**
     * @param Category|null $category
     * @return Collection
     */
    public function getTopPosts(Category $category = null): Collection;

    /**
     * @param Post $post
     * @return Collection
     */
    public function getRelatedPosts(Post $post): Collection;
}
