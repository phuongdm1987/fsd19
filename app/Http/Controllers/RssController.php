<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\Post\GetRssPosts;
use Illuminate\Http\Response;

/**
 * Class RssController
 * @package App\Http\Controllers
 */
class RssController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        $posts = GetRssPosts::dispatchNow();

        return response()->view('rss', compact('posts'))->header('Content-Type', 'text/xml');
    }
}
