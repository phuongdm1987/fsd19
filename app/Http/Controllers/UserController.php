<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\Post\GetByAuthor;
use App\Jobs\Post\GetTopPosts;
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

    public function showFollowers()
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

        if ($follow === '') {
            // Get posts
            $posts = GetByAuthor::dispatchNow($user);

            // Get top 5 hot the blog post
            $topPosts = GetTopPosts::dispatchNow();

            // Show the page
            return view('user.show', compact('posts', 'title', 'type' ,'user', 'value_type', 'topPosts'));

        }

        if($follow === 'followers' || $follow === 'following') {
            $list_user_follower = [];
            $list_object_user = [];

            $list_object_user = $this->mFollow->getUserFollowings($user, 15, ['cover','gravatar', 'nickname', 'id', 'hobbies']);
            if($follow === 'followers'){
                $list_object_user = $this->mFollow->getUserFollowers($user, 15, ['cover','gravatar', 'nickname', 'id', 'hobbies']);
            }

            foreach ($list_object_user as $key => $object_user) {
                if($author = $this->mUser->getUserById($object_user->id)){
                    $list_user_follower[$object_user->id][] = $author;
                }
            }

            return view('user-wall/follower', compact('user', 'type', 'value_type',  'list_object_user', 'list_user_follower', 'follow'));
        }

        if($follow === 'recommend') {
            return $this->getRecommendPosts([
                'user'       => $user,
                'value_type' => $value_type
            ]);
        }
    }
}
