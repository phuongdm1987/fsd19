<?php
declare(strict_types=1);

namespace App\Jobs\Tag;

use Henry\Domain\Tag\Repositories\TagRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class GetSearchTags
 * @package App\Jobs\Tag
 */
class GetSearchTags implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var string
     */
    private $keyword;
    /**
     * @var int
     */
    private $limit;

    /**
     * Create a new job instance.
     * @param string $keyword
     * @param int $limit
     */
    public function __construct(string $keyword, int $limit = 5)
    {
        $this->keyword = $keyword;
        $this->limit = $limit;
    }

    /**
     * Execute the job.
     * @param TagRepositoryInterface $tagRepository
     * @return array
     */
    public function handle(TagRepositoryInterface $tagRepository): array
    {
        $tags = $tagRepository->getBySearch($this->keyword, $this->limit);

        return array_map(function($tag) {
            $tag['label'] = $tag['name'];
            $tag['value'] = $tag['name'];

            return $tag;
        }, $tags->toArray());
    }
}
