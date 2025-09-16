<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNewsCategoryRequest;
use App\Http\Requests\UpdateNewsCategoryRequest;
use App\Models\News;
use App\Repositories\NewsCategoryRepository;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Response;

class NewsCategoryController extends AppBaseController
{
    /** @var NewsCategoryRepository */
    private $newsCategoryRepository;

    public function __construct(NewsCategoryRepository $newsCategoryRepo)
    {
        $this->newsCategoryRepository = $newsCategoryRepo;
    }

    /**
     * Display a listing of the NewsCategory.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.news_categories.index');
    }

    /**
     * Show the form for creating a new NewsCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.news_categories.create');
    }

    /**
     * Store a newly created NewsCategory in storage.
     *
     * @param  CreateNewsCategoryRequest  $request
     * @return Response
     */
    public function store(CreateNewsCategoryRequest $request)
    {
        $input = $request->all();

        $newsCategory = $this->newsCategoryRepository->create($input);

        return $this->sendSuccess('News Category saved successfully.');
    }

    /**
     * Display the specified NewsCategory.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $newsCategory = $this->newsCategoryRepository->find($id);

        if (empty($newsCategory)) {
            Flash::error('News Category not found');

            return redirect(route('news-categories.index'));
        }

        return view('admin.news_categories.show')->with('newsCategory', $newsCategory);
    }

    /**
     * Show the form for editing the specified NewsCategory.
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $newsCategory = $this->newsCategoryRepository->find($id);

        if (empty($newsCategory)) {
            return $this->sendError('News Category not found');
        }

        return $this->sendResponse($newsCategory, 'News Category retrieved successfully');
    }

    /**
     * Update the specified NewsCategory in storage.
     *
     * @param $id
     * @param  UpdateNewsCategoryRequest  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update($id, UpdateNewsCategoryRequest $request)
    {
        $newsCategory = $this->newsCategoryRepository->find($id);

        if (empty($newsCategory)) {
            Flash::error('News Category not found');

            return redirect(route('news-categories.index'));
        }

        $newsCategory = $this->newsCategoryRepository->update($request->all(), $id);

        return $this->sendSuccess('News Category updated successfully.');
    }

    /**
     * Remove the specified NewsCategory from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $newsCategoryCount = News::where('news_category_id', $id)->count();
        if ($newsCategoryCount > 0) {
            return   $this->sendError('News Category can\'t be deleted');
        }

        $newsCategory = $this->newsCategoryRepository->find($id);

        $newsCategory->delete();

        return $this->sendSuccess('News Category deleted successfully.');
    }
}
