<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSecondSliderRequest;
use App\Http\Requests\UpdateSecondSliderRequest;
use App\Models\FrontSlider2;
use App\Repositories\FrontSlider2Repository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class FrontSlider2Controller extends AppBaseController
{
    /**
     * @var FrontSlider2Repository
     */
    public FrontSlider2Repository $frontSlider2Repo;

    /**
     * FrontSlider2Controller constructor.
     *
     * @param  FrontSlider2Repository  $frontSlider2Repo
     */
    public function __construct(FrontSlider2Repository $frontSlider2Repo)
    {
        $this->frontSlider2Repo = $frontSlider2Repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.front-cms2.sliders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.front-cms2.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateSecondSliderRequest  $request
     * @return Application|Redirector|RedirectResponse
     */
    public function store(CreateSecondSliderRequest $request)
    {
        $frontSliderCount = FrontSlider2::count();
        if ($frontSliderCount > 10) {
            Flash::error('You can not add more than 10 slider.');

            return redirect(route('second-slider.create'));
        }

        $input = $request->all();
        $this->frontSlider2Repo->store($input);

        Flash::success('Slider created successfully.');

        return redirect(route('second-slider.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  FrontSlider2  $secondSlider
     * @return Application|Factory|View
     */
    public function edit(FrontSlider2 $secondSlider)
    {
        return view('admin.front-cms2.sliders.edit', compact('secondSlider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSecondSliderRequest  $request
     * @param  FrontSlider2  $secondSlider
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateSecondSliderRequest $request, FrontSlider2 $secondSlider)
    {
        $input = $request->all();
        $this->frontSlider2Repo->update($input, $secondSlider->id);

        Flash::success('Second Front Slider updated successfully.');

        return redirect(route('second-slider.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  FrontSlider2  $secondSlider
     * @return JsonResponse
     */
    public function destroy(FrontSlider2 $secondSlider)
    {
        try {
            DB::beginTransaction();

            $secondSlider->clearMediaCollection(FrontSlider2::FRONT_SLIDER_IMAGE);
            $secondSlider->media()->delete();
            $secondSlider->delete();

            DB::commit();

            return $this->sendSuccess('Second Front Slider deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
