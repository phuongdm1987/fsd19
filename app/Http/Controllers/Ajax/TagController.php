<?php
declare(strict_types=1);

namespace App\Http\Controllers\Ajax;

use App\Jobs\Tag\GetSearchTags;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class TagController
 * @package App\Http\Controllers\Ajax
 */
class TagController extends Controller
{
    /**
     * @param Request $request
     * @return array
     */
    public function getSuggest(Request $request): array
    {
        $keyword = (string)$request->get('term', '');

        return GetSearchTags::dispatchNow($keyword);
    }
}
