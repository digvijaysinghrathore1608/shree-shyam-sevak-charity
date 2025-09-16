<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateVideoSectionRequest;
use App\Models\VideoSection;
use App\Repositories\VideoSectionRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Laracasts\Flash\Flash;

class VideoSectionController extends AppBaseController
{
    /**
     * @var VideoSectionRepository
     */
    private $videoSectionRepository;

    /**
     * VideoSectionController constructor.
     *
     * @param  VideoSectionRepository  $videoSectionRepository
     */
    public function __construct(VideoSectionRepository $videoSectionRepository)
    {
        $this->videoSectionRepository = $videoSectionRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $videoSection = VideoSection::pluck('value', 'key')->toArray();

        return view('admin.front-cms.video-section.index',
            compact('videoSection'));
    }

    /**
     * @param  UpdateVideoSectionRequest  $request
     * @return RedirectResponse
     */
    public function update(UpdateVideoSectionRequest $request)
    {
        $this->videoSectionRepository->updateData($request->all());

        Flash::success('Video Section updated successfully.');

        return Redirect(route('video-section.index'));
    }
}
