<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFrontSliderThirdRequest;
use App\Http\Requests\UpdateFrontSliderThirdRequest;
use App\Models\FrontSliderThird;
use App\Repositories\FrontSliderThirdRepository;
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

class FrontSliderThirdController extends AppBaseController
{
    /**
     * @var FrontSliderThirdRepository
     */
    public FrontSliderThirdRepository $frontSliderThirdRepo;

    /**
     * FrontSliderThirdController constructor.
     *
     * @param  FrontSliderThirdRepository  $frontSliderThirdRepo
     */
    public function __construct(FrontSliderThirdRepository $frontSliderThirdRepo)
    {
        $this->frontSliderThirdRepo = $frontSliderThirdRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     *
     * @throws Exception|Exception
     */
    public function index()
    {
        return view('admin.front-cms3.sliders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.front-cms3.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateFrontSliderThirdRequest  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateFrontSliderThirdRequest $request)
    {
        $frontSliderCount = FrontSliderThird::count();
        if ($frontSliderCount > 10) {
            Flash::error('You can not add more than 10 slider.');

            return redirect(route('third-slider.create'));
        }

        $input = $request->all();
        $this->frontSliderThirdRepo->store($input);

        Flash::success('Slider created successfully.');

        return redirect(route('third-slider.index'));
    }

    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  FrontSliderThird  $thirdSlider
     * @return Application|Factory|View
     */
    public function edit(FrontSliderThird $thirdSlider)
    {
        return view('admin.front-cms3.sliders.edit', compact('thirdSlider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateFrontSliderThirdRequest  $request
     * @param  FrontSliderThird  $thirdSlider
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateFrontSliderThirdRequest $request, FrontSliderthird $thirdSlider)
    {
        $input = $request->all();
        $this->frontSliderThirdRepo->update($input, $thirdSlider->id);

        Flash::success('Third Front Slider updated successfully.');

        return redirect(route('third-slider.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  FrontSliderThird  $thirdSlider
     * @return JsonResponse
     */
    public function destroy(FrontSliderThird $thirdSlider)
    {
        try {
            DB::beginTransaction();

            $thirdSlider->clearMediaCollection(FrontSliderThird::FRONT_SLIDER_IMAGE);
            $thirdSlider->media()->delete();
            $thirdSlider->delete();

            DB::commit();

            return $this->sendSuccess('Third Front Slider deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
