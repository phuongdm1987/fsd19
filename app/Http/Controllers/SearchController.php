<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\Post\GetSearchPosts;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class SearchController
 * @package App\Http\Controllers
 */
class SearchController extends WebController
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $q = $request->get('q', '');
        $q_search = str_slug($q);

        // Metadata
        $title = 'Tìm kiếm theo từ khóa <span class="head-kw">' . $q . '</span>';
        $desc = 'Tìm kiếm và tổng hợp các bài viết, hướng dẫn, kiến thức, thảo luận cơ bản các vấn đề, đề tài theo từ khóa ' . $q;

        $this->metadata->setTitle(strip_tags($title));
        $this->metadata->setDescription($desc);
        $this->metadata->appendKeywords(['bài viết', 'thảo luận', 'hướng dẫn', 'kiến thức', 'hỏi đáp', $q]);

        // Posts
        $posts = GetSearchPosts::dispatchNow($q_search);

        $type = 'từ khóa';
        $value_type = $q;

        return view('search', compact('posts', 'type', 'value_type'));
    }
}
