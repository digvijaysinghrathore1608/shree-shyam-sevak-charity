<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAboutUsRequest;
use App\Models\AboutUs;
use App\Repositories\AboutUsRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;

class AboutUsController extends AppBaseController
{
    /**
     * @var AboutUsRepository
     */
    private $aboutUsRepository;

    /**
     * @param  AboutUsRepository  $aboutUsRepository
     */
    public function __construct(AboutUsRepository $aboutUsRepository)
    {
        $this->aboutUsRepository = $aboutUsRepository;
    }

    /**
     * @return Factory|Application|View
     */
    public function index()
    {
        $aboutUs = AboutUs::pluck('value', 'key')->toArray();

        return view('admin.front-cms.about-us.index',
            compact('aboutUs'));
    }

    /**
     * @param  UpdateAboutUsRequest  $request
     * @return RedirectResponse
     */
    public function update(UpdateAboutUsRequest $request)
    {
        $this->aboutUsRepository->updateData($request->all());

        Flash::success('About us updated successfully.');

        return Redirect::back();
    }
}
