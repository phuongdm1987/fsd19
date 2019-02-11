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
 * Class GetChildren
 * @package App\Jobs\Category
 */
class GetChildren implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Category
     */
    private $category;

    /**
     * Create a new job instance.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        $children = [$this->category];

        return $this->getChildren($this->category, $children);
    }

    /**
     * @param Category $category
     * @param array $children
     * @return array
     */
    private function getChildren(Category $category, array &$children): array
    {
        foreach ($category->children as $child) {
            $children[] = $child;
            if ($child->children) {
                $this->getChildren($child, $children);
            }
        }

        return $children;
    }
}
