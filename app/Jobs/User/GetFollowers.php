<?php
declare(strict_types=1);

namespace App\Jobs\User;

use Henry\Domain\User\Repositories\UserRepositoryInterface;
use Henry\Domain\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class GetFollowers
 * @package App\Jobs\User
 */
class GetFollowers implements ShouldQueue
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
     * Create a new job instance.
     *
     * @param User $user
     * @param int $limit
     */
    public function __construct(User $user, int $limit = 15)
    {
        $this->user = $user;
        $this->limit = $limit;
    }

    /**
     * Execute the job.
     *
     * @param UserRepositoryInterface $userRepository
     * @return LengthAwarePaginator
     */
    public function handle(UserRepositoryInterface $userRepository): LengthAwarePaginator
    {
        $followerIds = $this->user->followers->pluck('id');

        return $userRepository->withPaginate([
            'id' => $followerIds
        ], $this->limit);
    }
}
