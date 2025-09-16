<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;

class CategoryController extends AppBaseController
{
    /**
     * @var CategoryRepository
     */
    private CategoryRepository $categoryRepository;

    /**
     * CategoryController constructor.
     *
     * @param  CategoryRepository  $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return Factory|Application|View
     */
    public function index()
    {
        $category = Category::pluck('value', 'key')->toArray();

        return view('admin.front-cms2.categories.index',
            compact('category'));
    }

    /**
     * @param  UpdateCategoryRequest  $request
     * @return RedirectResponse
     */
    public function update(UpdateCategoryRequest $request)
    {
        $this->categoryRepository->updateData($request->all());

        Flash::success('Category updated successfully.');

        return Redirect::back();
    }
}
