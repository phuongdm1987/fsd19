<?php
declare(strict_types=1);

namespace App\Jobs\Category;

use Henry\Domain\Category\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class GetParents
 * @package App\Jobs\Category
 */
class GetParents implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Category
     */
    private $category;

    /**
     * GetParents constructor.
     * @param Category|null $category
     */
    public function __construct(Category $category = null)
    {
        //
        $this->category = $category;
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        if($this->category === null) {
            return [];
        }

        $parents = [$this->category];

        return $this->getParents($this->category, $parents);
    }

    /**
     * @param Category $category
     * @param array $parents
     * @return array
     */
    private function getParents(Category $category, array &$parents): array
    {
        if ($category->parents > 0) {
            $parents[] = $category->relationParent;
            $this->getParents($category->relationParent, $parents);
        }

        return array_reverse($parents);
    }
}
