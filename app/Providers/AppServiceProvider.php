<?php
declare(strict_types=1);

namespace App\Providers;

use Henry\Domain\Category\Filters\CategoryFilterInterface;
use Henry\Domain\Category\Repositories\CategoryRepositoryInterface;
use Henry\Domain\Category\Sorters\CategorySorterInterface;
use Henry\Domain\Post\Filters\PostFilterInterface;
use Henry\Domain\Post\Repositories\PostRepositoryInterface;
use Henry\Domain\Post\Sorters\PostSorterInterface;
use Henry\Domain\Subscriber\Filters\SubscriberFilterInterface;
use Henry\Domain\Subscriber\Repositories\SubscriberRepositoryInterface;
use Henry\Domain\Subscriber\Sorters\SubscriberSorterInterface;
use Henry\Domain\Tag\Filters\TagFilterInterface;
use Henry\Domain\Tag\Repositories\TagRepositoryInterface;
use Henry\Domain\Tag\Sorters\TagSorterInterface;
use Henry\Domain\User\Filters\UserFilterInterface;
use Henry\Domain\User\Repositories\UserRepositoryInterface;
use Henry\Domain\User\Sorters\UserSorterInterface;
use Henry\Infrastructure\Category\Filters\EloquentCategoryFilter;
use Henry\Infrastructure\Category\Repositories\EloquentCategoryRepository;
use Henry\Infrastructure\Category\Sorters\EloquentCategorySorter;
use Henry\Infrastructure\Post\Filters\EloquentPostFilter;
use Henry\Infrastructure\Post\Repositories\EloquentPostRepository;
use Henry\Infrastructure\Post\Sorters\EloquentPostSorter;
use Henry\Infrastructure\Subscriber\Filters\EloquentSubscriberFilter;
use Henry\Infrastructure\Subscriber\Repositories\EloquentSubscriberRepository;
use Henry\Infrastructure\Subscriber\Sorters\EloquentSubscriberSorter;
use Henry\Infrastructure\Tag\Filters\EloquentTagFilter;
use Henry\Infrastructure\Tag\Repositories\EloquentTagRepository;
use Henry\Infrastructure\Tag\Sorters\EloquentTagSorter;
use Henry\Infrastructure\User\Filters\EloquentUserFilter;
use Henry\Infrastructure\User\Repositories\EloquentUserRepository;
use Henry\Infrastructure\User\Sorters\EloquentUserSorter;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        UserRepositoryInterface::class => EloquentUserRepository::class,
        UserFilterInterface::class => EloquentUserFilter::class,
        UserSorterInterface::class => EloquentUserSorter::class,

        CategoryRepositoryInterface::class => EloquentCategoryRepository::class,
        CategoryFilterInterface::class => EloquentCategoryFilter::class,
        CategorySorterInterface::class => EloquentCategorySorter::class,

        PostRepositoryInterface::class => EloquentPostRepository::class,
        PostFilterInterface::class => EloquentPostFilter::class,
        PostSorterInterface::class => EloquentPostSorter::class,

        TagRepositoryInterface::class => EloquentTagRepository::class,
        TagFilterInterface::class => EloquentTagFilter::class,
        TagSorterInterface::class => EloquentTagSorter::class,

        SubscriberRepositoryInterface::class => EloquentSubscriberRepository::class,
        SubscriberFilterInterface::class => EloquentSubscriberFilter::class,
        SubscriberSorterInterface::class => EloquentSubscriberSorter::class,
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
