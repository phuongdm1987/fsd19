<?php
declare(strict_types=1);

namespace App\Jobs\Category;

use Henry\Domain\Category\Repositories\CategoryRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Collection;

/**
 * Class GetSelectBox
 * @package App\Jobs\Category
 */
class GetSelectBox implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var int
     */
    private $currentId;
    /**
     * @var string
     */
    private $strLevel;
    /**
     * @var Collection|null
     */
    private $categories;
    /**
     * @var string
     */
    private $html;

    /**
     * Create a new job instance.
     * @param int $currentId
     * @param string $strLevel
     * @param Collection|null $categories
     * @param string $html
     */
    public function __construct(
        int $currentId = 0,
        string $strLevel = '&rarr;',
        Collection $categories = null,
        &$html = '')
    {
        $this->currentId = $currentId;
        $this->strLevel = $strLevel;
        $this->categories = $categories;
        $this->html = $html;
    }

    /**
     * @param CategoryRepositoryInterface $categoryRepository
     * @return string
     */
    public function handle(CategoryRepositoryInterface $categoryRepository): string
    {
        return $categoryRepository->generateSelectBox(
            $this->currentId, $this->strLevel, $this->categories, $this->html
        );
    }
}
