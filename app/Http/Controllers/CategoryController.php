<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Henry\Domain\Category\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    /**
     * @param Category $category
     * @return View
     */
    public function show(Category $category): View
    {
        return view('');
    }
}
