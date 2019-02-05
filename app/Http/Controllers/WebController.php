<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 02/02/2019
 * Time: 23:26
 */

namespace App\Http\Controllers;


use Henry\Domain\Category\Repositories\CategoryRepositoryInterface;
use Henry\Domain\Metadata\Metadata;
use Henry\Domain\Tag\Repositories\TagRepositoryInterface;
use Illuminate\Support\Facades\View;

/**
 * Class WebController
 * @package App\Http\Controllers
 */
class WebController extends Controller
{
    protected $metadata;

    /**
     * WebController constructor.
     * @param TagRepositoryInterface $tagRepository
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        TagRepositoryInterface $tagRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {

        $this->metadata = new Metadata;
        View::share('metadata', $this->metadata);

        $tags = $tagRepository->getTagCountArticles(9);
        View::share('tags', $tags);

        $categories = $categoryRepository->getParents();
        View::share('categories', $categories);
    }
}
