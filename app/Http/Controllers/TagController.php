<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\Post\GetByTag;
use App\Jobs\Post\GetTopPosts;
use Henry\Domain\Tag\Tag;
use Illuminate\View\View;

/**
 * Class TagController
 * @package App\Http\Controllers
 */
class TagController extends WebController
{
    /**
     * @param Tag $tag
     * @return View
     */
    public function show(Tag $tag): View
    {
        // Metadata
        $title = 'Tìm kiếm theo tag <span class="head-kw">' . $tag->slug . '</span>';
        $desc = $tag->slug . ' là gì? Tổng hợp các bài viết, hướng dẫn, kiến thức, thảo luận cơ bản các vấn đề, đề tài, tự học ' . $tag->slug;

        $this->metadata->setTitle(strip_tags($title));
        $this->metadata->setDescription($desc);
        $this->metadata->appendKeywords([
            'bài viết',
            'thảo luận',
            'hướng dẫn',
            'kiến thức',
            'hỏi đáp',
            $tag->slug,
        ]);

        $posts = GetByTag::dispatchNow($tag);
        // Get top 5 hot the blog post
        $topPosts = GetTopPosts::dispatchNow();

        $type = 'tag';
        $value_type = $tag->slug;

        return view('category.show', compact('posts', 'title', 'topPosts', 'type', 'value_type'));
    }
}
