<?php
declare(strict_types=1);

namespace App\Http\Controllers\Ajax;

use App\Http\Requests\Post\AddRecommendRequest;
use App\Jobs\Post\AddRecommend;
use App\Http\Controllers\Controller;
use App\Jobs\Post\GetSearchPosts;
use Illuminate\Http\Request;

/**
 * Class PostController
 * @package App\Http\Controllers\Api
 */
class PostController extends Controller
{
    /**
     * @param AddRecommendRequest $request
     * @return array
     */
    public function recommend(AddRecommendRequest $request): array
    {
        return $this->dispatchNow(AddRecommend::fromRequest($request));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getSuggest(Request $request)
    {
        $keyword = (string)$request->get('q', '');
        return GetSearchPosts::dispatchNow($keyword);
    }
}
