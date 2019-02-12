<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\Post\GetByAuthor;
use App\Jobs\Post\GetTopPosts;
use App\Jobs\User\GetFollowers;
use App\Jobs\User\GetFollowings;
use Henry\Domain\User\User;
use Illuminate\View\View;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends WebController
{
    /**
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        // Metadata
        $title = 'Bài viết của tác giả ' . $user->nickname;
        $desc = 'Tổng hợp các bài viết, hướng dẫn, kiến thức, thảo luận cơ bản các vấn đề, đề tài của tác giả ' . $user->nickname;

        $this->metadata->setTitle($title);
        $this->metadata->setDescription($desc);
        $this->metadata->appendKeywords([
            'bài viết',
            'thảo luận',
            'hướng dẫn',
            'kiến thức',
            'hỏi đáp',
            strtolower($user->nickname),
        ]);

        $type = 'user';
        $value_type ='';

        // Get posts
        $posts = GetByAuthor::dispatchNow($user);

        // Get top 5 hot the blog post
        $topPosts = GetTopPosts::dispatchNow();

        // Show the page
        return view('user.show', compact('posts', 'title', 'type' ,'user', 'value_type', 'topPosts'));
    }

    /**
     * @param User $user
     * @param string $follow
     * @return View
     */
    public function showFollow(User $user, string $follow): View
    {
        // Metadata
        //
        $title = 'Bài viết của tác giả ' . $user->nickname;
        $desc = 'Tổng hợp các bài viết, hướng dẫn, kiến thức, thảo luận cơ bản các vấn đề, đề tài của tác giả ' . $user->nickname;

        $this->metadata->setTitle($title);
        $this->metadata->setDescription($desc);
        $this->metadata->appendKeywords([
            'bài viết',
            'thảo luận',
            'hướng dẫn',
            'kiến thức',
            'hỏi đáp',
            strtolower($user->nickname),
        ]);

        $type = 'user';
        $value_type ='';

        if ($follow === 'followers') {
            $list_user_follower = GetFollowers::dispatchNow($user);
        } else {
            $list_user_follower = GetFollowings::dispatchNow($user);
        }

        return view('user.follower', compact('user', 'type', 'value_type', 'list_user_follower', 'follow'));
    }
}
