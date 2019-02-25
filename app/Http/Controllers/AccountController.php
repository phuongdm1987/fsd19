<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Jobs\Category\GetSelectBox;
use App\Jobs\Post\DeletePost;
use App\Jobs\Post\GetByAuthor;
use App\Jobs\Post\StorePost;
use App\Jobs\Post\UpdatePost;
use Henry\Domain\Post\Post;
use Henry\Support\Markdown;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class AccountController
 * @package App\Http\Controllers
 */
class AccountController extends WebController
{
    /**
     * @var Markdown
     */
    private $markdown;

    /**
     * AccountController constructor.
     * @param Markdown $markdown
     */
    public function __construct(Markdown $markdown)
    {
        parent::__construct();

        $this->markdown = $markdown;
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $user = auth()->user();
        $posts = GetByAuthor::dispatchNow($user, 15, [
            'active' => $request->get('active', 1),
            'schedule_post' => null
        ]);
        $current_post = $posts->first();

        return view('account.post_listing', compact('posts', 'current_post'));
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return View
     */
    public function blogShow(Request $request, Post $post): View
    {
        $user = auth()->user();
        $posts = GetByAuthor::dispatchNow($user, 15, [
            'active' => $request->get('active', 1),
            'schedule_post' => null
        ]);

        $current_post = $post;

        return view('account.post_listing', compact('posts', 'current_post'));
    }

    /**
     * @return View
     */
    public function blogCreate(): View
    {
        $selectBoxCategories = GetSelectBox::dispatchNow(old('category_id', 0));
        return view('account.create_post', compact('selectBoxCategories'));
    }

    /**
     * @param StorePostRequest $request
     * @return RedirectResponse
     */
    public function blogStore(StorePostRequest $request): RedirectResponse
    {
        $post = $this->dispatchNow(StorePost::fromRequest($request));
        return redirect()->route('account.posts.edit', $post->id)
            ->with('success', 'Bài viết của bạn đã được ' . ($post->active == 1 ? 'đăng' : 'lưu'));
    }

    /**
     * @param Post $post
     * @return View
     */
    public function blogEdit(Post $post): View
    {
        $selectBoxCategories = GetSelectBox::dispatchNow(old('category_id', $post->category_id));
        $raw_content = $this->markdown->convertHtmlToMarkdown($post->content);
        $raw_content = htmlspecialchars($raw_content);
        return view('account.edit_post', compact( 'post', 'raw_content', 'selectBoxCategories'));
    }

    /**
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function blogUpdate(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $this->dispatchNow(UpdatePost::fromRequest($post, $request));

        return redirect()->route('account.posts.edit', $post->id)
            ->with('success', 'Bài viết của bạn đã được ' . ($post->active === 1 ? 'cập nhật' : 'lưu'));
    }

    /**
     * @param Post $post
     * @return RedirectResponse
     */
    public function blogDelete(Post $post): RedirectResponse
    {
        DeletePost::dispatchNow($post);
        return redirect()->route('account.index')->with('success', 'Hoàn thành xóa bài viết.');
    }
}
