<?php
declare(strict_types=1);

namespace Henry\Infrastructure\Post\Sorters;


use Henry\Domain\Post\Sorters\PostSorterInterface;
use Henry\Infrastructure\AbstractEloquentSorter;

/**
 * Class EloquentPostSorter
 * @package Henry\Infrastructure\Post\Sorters
 */
class EloquentPostSorter extends AbstractEloquentSorter implements PostSorterInterface
{
    /**
     * @var array
     */
    protected $fields = ['created_at'];
}
