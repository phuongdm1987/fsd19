<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\GetRecommendPosts;
use App\Jobs\GetTopPosts;
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

        return view('blog', compact('type', 'posts', 'topPosts'));
    }

    public function show(Post $post, $slug)
    {
        // Redirect 301
        if($post->slug !== $slug) {
            header('HTTP/1.1 301 Moved Permanently');
            header( 'Location:  ' . route('posts.show', [$post->id, $post->slug]));
            exit;
        }

    }
}
