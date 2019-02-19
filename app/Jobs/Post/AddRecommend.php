<?php
declare(strict_types=1);

namespace App\Jobs\Post;

use App\Http\Requests\Post\AddRecommendRequest;
use Henry\Domain\Post\Post;
use Henry\Domain\Post\Repositories\PostRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class AddRecommend
 * @package App\Jobs\Post
 */
class AddRecommend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var int
     */
    private $postId;

    /**
     * Create a new job instance.
     * @param int $postId
     */
    public function __construct(int $postId)
    {
        $this->postId = $postId;
    }

    /**
     * @param AddRecommendRequest $request
     * @return self
     */
    public static function fromRequest(AddRecommendRequest $request): self
    {
        return new static($request->postId());
    }

    /**
     * @param PostRepositoryInterface $postRepository
     * @return array
     */
    public function handle(PostRepositoryInterface $postRepository): array
    {
        $result = [
            'code' => 0,
            'message' => 'Không tồn tại user hoặc bài viết này'
        ];

        /** @var Post $post */
        $post = $postRepository->findById($this->postId);
        $userId = auth()->id();

        if (!$post) {
            return $result;
        }

        $post->favoriteUsers()->toggle([$userId => ['created_at' => now(), 'updated_at' => now()]]);

        $result['code'] = $post->isFavorite() ? 1 : -1;
        $result['message'] = $post->isFavorite() ? 'Recommend' : 'UnRecommend';

        return $result;
    }
}
