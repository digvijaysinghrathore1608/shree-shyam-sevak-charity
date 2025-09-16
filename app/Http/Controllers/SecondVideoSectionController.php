<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSecondVideoSectionRequest;
use App\Models\SecondVideoSection;
use App\Repositories\SecondVideoSectionRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Laracasts\Flash\Flash;

class SecondVideoSectionController extends Controller
{
    /**
     * @var SecondVideoSectionRepository
     */
    private SecondVideoSectionRepository $secondVideoSectionRepository;

    /**
     * VideoSectionController constructor.
     *
     * @param  SecondVideoSectionRepository  $secondVideoSectionRepository
     */
    public function __construct(SecondVideoSectionRepository $secondVideoSectionRepository)
    {
        $this->secondVideoSectionRepository = $secondVideoSectionRepository;
    }

    /**
     * @return Factory|Application|View
     */
    public function index()
    {
        $secondVideoSection = SecondVideoSection::pluck('value', 'key')->toArray();

        return view('admin.front-cms2.video-section.index',
            compact('secondVideoSection'));
    }

    /**
     * @param  UpdateSecondVideoSectionRequest  $request
     * @return RedirectResponse
     */
    public function update(UpdateSecondVideoSectionRequest $request)
    {
        $this->secondVideoSectionRepository->updateData($request->all());

        Flash::success('Video Section updated successfully.');

        return Redirect(route('second-video-section.index'));
    }
}
