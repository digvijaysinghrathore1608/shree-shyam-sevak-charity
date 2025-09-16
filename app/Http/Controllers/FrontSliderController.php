<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFrontSliderRequest;
use App\Http\Requests\UpdateFrontSliderRequest;
use App\Http\Requests\UpdateSliderCardRequest;
use App\Models\FrontSlider;
use App\Models\SliderCard;
use App\Repositories\FrontSliderRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class FrontSliderController extends AppBaseController
{
    /**
     * @var FrontSliderRepository
     */
    public FrontSliderRepository $frontSliderRepo;

    /**
     * FrontSliderController constructor.
     *
     * @param  FrontSliderRepository  $frontSliderRepo
     */
    public function __construct(FrontSliderRepository $frontSliderRepo)
    {
        $this->frontSliderRepo = $frontSliderRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        $sliderCard = SliderCard::pluck('value', 'key')->toArray();

        return view('admin.front-cms.sliders.index', compact('sliderCard'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.front-cms.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateFrontSliderRequest  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateFrontSliderRequest $request)
    {
        $frontSliderCount = FrontSlider::count();
        if ($frontSliderCount > 10) {
            Flash::error('You can not add more than 10 slider.');

            return redirect(route('sliders.create'));
        }

        $input = $request->all();
        $this->frontSliderRepo->store($input);

        Flash::success('Front Slider created successfully.');

        return redirect(route('sliders.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  FrontSlider  $slider
     * @return Application|Factory|View
     */
    public function edit(FrontSlider $slider)
    {
        return view('admin.front-cms.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateFrontSliderRequest  $request
     * @param  FrontSlider  $slider
     * @return Application|Redirector|RedirectResponse
     */
    public function update(UpdateFrontSliderRequest $request, FrontSlider $slider)
    {
        $input = $request->all();
        $this->frontSliderRepo->update($input, $slider->id);

        Flash::success('Front Slider updated successfully.');

        return redirect(route('sliders.index'));
    }

    /**
     * @param  UpdateSliderCardRequest  $request
     * @return RedirectResponse
     */
    public function updateSliderCard(UpdateSliderCardRequest $request)
    {
        $this->frontSliderRepo->updateData($request->all());

        Flash::success('Card Slider updated successfully.');

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  FrontSlider  $slider
     * @return mixed
     */
    public function destroy(FrontSlider $slider)
    {
        try {
            DB::beginTransaction();

            $slider->clearMediaCollection(FrontSlider::FRONT_SLIDER_IMAGE);
            $slider->media()->delete();
            $slider->delete();

            DB::commit();

            return $this->sendSuccess('Front Slider deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
