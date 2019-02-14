<?php
declare(strict_types=1);

namespace Henry\Domain\Category\Repositories;


use Henry\Domain\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

/**
 * Interface CategoryRepositoryInterface
 * @package Henry\Domain\Category\Repositories\
 */
interface CategoryRepositoryInterface extends RepositoryInterface
{
    /**
     * @return Collection
     */
    public function getParents(): Collection;

    /**
     * @param int $currentId
     * @param string $strLevel
     * @param SupportCollection|null $categories
     * @param string $html
     * @return string
     */
    public function generateSelectBox(int $currentId = 0,
        string $strLevel = '&rarr;',
        SupportCollection $categories = null,
        string &$html = ''): string;
}
