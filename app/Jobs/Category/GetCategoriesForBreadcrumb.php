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
 * Class GetCategoriesForBreadcrumb
 * @package App\Jobs\Category
 */
class GetCategoriesForBreadcrumb implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Category
     */
    private $category;

    /**
     * Create a new job instance.
     *
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        //
        $this->category = $category;
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        $breadcrumbs = [$this->category];

        return $this->getParents($this->category, $breadcrumbs);
    }

    /**
     * @param Category $category
     * @param array $breadcrumbs
     * @return array
     */
    private function getParents(Category $category, array &$breadcrumbs): array
    {
        if ($category->parents > 0) {
            $breadcrumbs[] = $category->relationParent;
            $this->getParents($category->relationParent, $breadcrumbs);
        }

        return array_reverse($breadcrumbs);
    }
}
