<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\Post\GetByAuthor;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class AccountController
 * @package App\Http\Controllers
 */
class AccountController extends WebController
{
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
}
