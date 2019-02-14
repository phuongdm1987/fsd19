<?php
declare(strict_types=1);

namespace App\Jobs\Post;

use Henry\Domain\Post\Post;
use Henry\Domain\Post\Repositories\PostRepositoryInterface;
use Henry\Domain\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class GetByAuthor
 * @package App\Jobs\Post
 */
class GetByAuthor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var User
     */
    private $user;
    /**
     * @var int
     */
    private $limit;
    /**
     * @var array
     */
    private $conditions;

    /**
     * Create a new job instance.
     * @param User $user
     * @param int $limit
     * @param array $conditions
     */
    public function __construct(User $user, int $limit = 10, $conditions = [])
    {
        $this->user = $user;
        $this->limit = $limit;
        $this->conditions = $conditions;
    }

    /**
     * @param PostRepositoryInterface $postRepository
     * @return LengthAwarePaginator
     */
    public function handle(PostRepositoryInterface $postRepository): LengthAwarePaginator
    {
        $conditions = [
            'user_id' => $this->user->id,
            'active' => Post::PUBLISHED,
            'schedule_post' => ['operator' => '<=', time()],
            'orderBy' => 'created_at',
            'order' => 'desc'
        ];

        $conditions = array_merge($conditions, $this->conditions);

        $posts = $postRepository->withPaginate($conditions, $this->limit);

        $posts->load('author', 'category', 'relationTags', 'favoriteUsers');

        return $posts;
    }
}
