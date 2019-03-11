<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\Post\GetSiteMapPosts;
use Illuminate\Http\Response;

/**
 * Class SiteMapController
 * @package App\Http\Controllers
 */
class SiteMapController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        $posts = GetSiteMapPosts::dispatchNow();

        return response()->view('site-map', compact('posts'))->header('Content-Type', 'text/xml');
    }
}
