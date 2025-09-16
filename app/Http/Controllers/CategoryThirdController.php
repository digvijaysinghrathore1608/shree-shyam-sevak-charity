<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryThirdRequest;
use App\Http\Requests\UpdateCategoryThirdRequest;
use App\Models\CategoryThird;
use App\Repositories\CategoryThirdRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class CategoryThirdController extends AppBaseController
{
    /**
     * @var CategoryThirdRepository
     */
    private CategoryThirdRepository $categoryThirdRepository;

    /**
     * CategoryThirdController constructor.
     *
     * @param  CategoryThirdRepository  $categoryThirdRepository
     */
    public function __construct(CategoryThirdRepository $categoryThirdRepository)
    {
        $this->categoryThirdRepository = $categoryThirdRepository;
    }

    /**
     * @return Factory|Application|View
     */
    public function index()
    {
        return view('admin.front-cms3.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.front-cms3.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCategoryThirdRequest  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateCategoryThirdRequest $request)
    {
        $categoryTitleCount = CategoryThird::count();
        if ($categoryTitleCount == 6) {
            Flash::error('You can not add more than 6 categories.');

            return redirect(route('third-categories.create'));
        }

        $input = $request->all();
        $this->categoryThirdRepository->store($input);

        Flash::success('Category created successfully.');

        return redirect(route('third-categories.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  CategoryThird  $thirdCategories
     * @return Application|Factory|View
     */
    public function edit(CategoryThird $thirdCategory)
    {
        return view('admin.front-cms3.categories.edit', compact('thirdCategory'));
    }

    /**
     * @param $id
     * @param  UpdateCategoryThirdRequest  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update($id, UpdateCategoryThirdRequest $request)
    {
        $categoryThird = $this->categoryThirdRepository->find($id);

        if (empty($categoryThird)) {
            Flash::error('Category not found');

            return redirect(route('third-categories.index'));
        }

        $categoryThird = $this->categoryThirdRepository->update($request->all(), $id);

        Flash::success('Category updated successfully.');

        return redirect(route('third-categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  CategoryThird  $thirdCategory
     * @return JsonResponse
     */
    public function destroy(CategoryThird $thirdCategory)
    {
        try {
            DB::beginTransaction();

            $thirdCategory->clearMediaCollection(CategoryThird::PATH);
            $thirdCategory->media()->delete();
            $thirdCategory->delete();

            DB::commit();

            return $this->sendSuccess('Category deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
