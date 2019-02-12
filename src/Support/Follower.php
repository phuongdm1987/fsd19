<?php
declare(strict_types=1);

namespace Henry\Support;

use Henry\Domain\User\User;

/**
 * Class Follower
 */
class Follower{

    /**
     * @param User $user
     * @return string
     */
    public static function createButtonFollow(User $user): string
    {

		$dataStatus 	= 'notfollow';
		$class      	= 'follow';
		$text       	= 'Follow';
        $classExternal 	= 'btn-danger';
		$icon			= 'fa-user-plus';

		if(auth()->check() && $user->followings->contains('id', auth()->id())) {
			$dataStatus 	= 'follower';
			$class      	= 'unfollow';
			$text       	= 'Unfollow';
			$classExternal 	= 'btn-info';
			$icon				= 'fa-user-plus';
		}

		$html = '<div data-followstatus="'.$dataStatus.'" data-token="'. csrf_token() .'" data-urlreturn="'.base64_encode($_SERVER['REQUEST_URI']).'" data-uid="'.$user->id.'" class="btn btn-xs js-btn-follow btn-follow-cc '.$class . ' ' . $classExternal .'"><i class="fa '.$icon.'"></i> '. $text .'</div>';

		return $html;
	}

    /**
     * @param User $user
     * @return string
     */
    public static function getCountFollowerAndFollowings(User $user): string
    {
		$html = '';

		// Đếm số lượng người theo dõi user
		$count_followers = $user->followers->count();

		// Đếm số lượng người user đang theo dõi
		$count_following = $user->followings->count();

		$html .= '<ul class="list-inline">';
		$html .= "<li><a href='". $user->getFollowPageUrl() ."' class='link-title'> $count_followers Follow</a><li>";
		$html .= "<li><a href='". $user->getFollowPageUrl('following') ."' class='link-title'> $count_following Following</a></li>";
		$html .= '</ul>';

		return $html;
	}
}
