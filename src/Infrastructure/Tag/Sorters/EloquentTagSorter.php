<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Tag\Sorters;


use Henry\Domain\Tag\Sorters\TagSorterInterface;
use Henry\Infrastructure\AbstractEloquentSorter;

/**
 * Class EloquentTagSorter
 * @package Henry\Infrastructure\Tag\Sorters
 */
class EloquentTagSorter extends AbstractEloquentSorter implements TagSorterInterface
{
    /**
     * @var array
     */
    protected $fields = [];
}
