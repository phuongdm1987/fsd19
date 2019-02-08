<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\Category\GetCategoriesForBreadcrumb;
use App\Jobs\Post\GetRecommendPosts;
use App\Jobs\Post\GetRelatedPosts;
use App\Jobs\Post\GetTopPosts;
use App\Jobs\Post\IncrementViewPost;
use Henry\Domain\Post\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class BlogController
 * @package App\Http\Controllers
 */
class BlogController extends WebController
{

    /**
     * @return View
     */
    public function index(): View
    {
        $this->metadata->setTitle('Trang chủ');

        $type = '';
        $posts = GetRecommendPosts::dispatchNow();
        $topPosts = GetTopPosts::dispatchNow();

        return view('blog.index', compact('type', 'posts', 'topPosts'));
    }

    public function show(Post $post, $slug)
    {
        // Redirect 301
        if($post->slug !== $slug) {
            header('HTTP/1.1 301 Moved Permanently');
            header( 'Location:  ' . route('posts.show', [$post->id, $post->slug]));
            exit;
        }

        // Increment views
        IncrementViewPost::dispatchNow($post);
        $breadcrumbs = GetCategoriesForBreadcrumb::dispatchNow($post->category);
        $topPosts = GetTopPosts::dispatchNow($post->category);
        $relatedPosts = GetRelatedPosts::dispatchNow($post);

        // Metadata
        $desc = str_limit(strip_tags($post->content), 30);
        $desc = str_replace(["\n", '  '], [' ', ''], $desc);
        $keywords = ['bài viết, thảo luận, hướng dẫn, kiến thức, hỏi đáp'];
        $keywords = array_merge($keywords, $post->relationTags->pluck('name')->toArray());

        $this->metadata->setTitle($post->title);
        $this->metadata->setDescription($desc);
        $this->metadata->appendKeywords($keywords);
        $this->metadata->setOwner($post->author->nickname);

        $type = '';

        // Show the page
        return view('blog.show', compact('post', 'breadcrumbs', 'topPosts', 'type', 'relatedPosts'));
    }
}
