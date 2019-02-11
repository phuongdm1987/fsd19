<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\Category\GetChildren;
use App\Jobs\Category\GetParents;
use App\Jobs\Post\GetByCategory;
use App\Jobs\Post\GetTopPosts;
use Henry\Domain\Category\Category;
use Illuminate\View\View;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends WebController
{
    /**
     * @param Category $category
     * @return View
     */
    public function show(Category $category): View
    {
        // Metadata
        //
        $title = 'Danh mục ' . $category->name;
        $desc = $category->name . ' là gì? Tổng hợp các bài viết, hướng dẫn, kiến thức, thảo luận cơ bản các vấn đề, đề tài, tự học ' . $category->name;

        $this->metadata->setTitle($title);
        $this->metadata->setDescription($desc);
        $this->metadata->appendKeywords([
            'bài viết',
            'thảo luận',
            'hướng dẫn',
            'kiến thức',
            'hỏi đáp',
            strtolower($category->name),
        ]);

        $breadcrumbs = GetParents::dispatchNow($category);
        $categoryIds = GetChildren::dispatchNow($category);
        $categoryIds = array_pluck($categoryIds, 'id');

        // Get posts
        $posts = GetByCategory::dispatchNow($categoryIds);

        // Get top 5 hot the blog post
        $topPosts = GetTopPosts::dispatchNow($category);

        $type = 'category';
        $value_type = strtolower($category->name);

        $breadcrumbs[] = $category;
        // Show the page
        return view('category.show', compact('posts', 'title', 'topPosts', 'type', 'value_type', 'breadcrumbs', 'category'));
    }
}
