<?php
declare(strict_types=1);

namespace App\Providers;

use Henry\Domain\Post\Filters\PostFilterInterface;
use Henry\Domain\Post\Repositories\PostRepositoryInterface;
use Henry\Domain\Post\Sorters\PostSorterInterface;
use Henry\Domain\Tag\Filters\TagFilterInterface;
use Henry\Domain\Tag\Repositories\TagRepositoryInterface;
use Henry\Domain\Tag\Sorters\TagSorterInterface;
use Henry\Infrastructure\Post\Filters\EloquentPostFilter;
use Henry\Infrastructure\Post\Repositories\EloquentPostRepository;
use Henry\Infrastructure\Post\Sorters\EloquentPostSorter;
use Henry\Infrastructure\Tag\Filters\EloquentTagFilter;
use Henry\Infrastructure\Tag\Repositories\EloquentTagRepository;
use Henry\Infrastructure\Tag\Sorters\EloquentTagSorter;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        TagRepositoryInterface::class => EloquentTagRepository::class,
        TagFilterInterface::class => EloquentTagFilter::class,
        TagSorterInterface::class => EloquentTagSorter::class,

        PostRepositoryInterface::class => EloquentPostRepository::class,
        PostFilterInterface::class => EloquentPostFilter::class,
        PostSorterInterface::class => EloquentPostSorter::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
