<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateVideoSectionThirdRequest;
use App\Models\ThirdVideoSection;
use App\Repositories\ThirdVideoSectionRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Laracasts\Flash\Flash;

class ThirdVideoSectionController extends Controller
{
    /**
     * @var ThirdVideoSectionRepository
     */
    private ThirdVideoSectionRepository $thirdVideoSectionRepository;

    /**
     * VideoSectionController constructor.
     *
     * @param  ThirdVideoSectionRepository  $thirdVideoSectionRepository
     */
    public function __construct(ThirdVideoSectionRepository $thirdVideoSectionRepository)
    {
        $this->thirdVideoSectionRepository = $thirdVideoSectionRepository;
    }

    /**
     * @return Factory|Application|View
     */
    public function index()
    {
        $thirdVideoSection = ThirdVideoSection::pluck('value', 'key')->toArray();

        return view('admin.front-cms3.video-section.index',
            compact('thirdVideoSection'));
    }

    /**
     * @param  UpdateVideoSectionThirdRequest  $request
     * @return RedirectResponse
     */
    public function update(UpdateVideoSectionThirdRequest $request)
    {
        $this->thirdVideoSectionRepository->updateData($request->all());

        Flash::success('Video Section updated successfully.');

        return Redirect(route('third-video-section.index'));
    }
}
