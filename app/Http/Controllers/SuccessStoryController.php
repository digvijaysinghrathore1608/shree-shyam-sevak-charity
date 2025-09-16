<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSuccessStoryRequest;
use App\Http\Requests\UpdateStorySuccessRequest;
use App\Models\SuccessStory;
use App\Repositories\SuccessStoryRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;

class SuccessStoryController extends AppBaseController
{
    /**
     * @param  SuccessStoryRepository  $successStoryRepo
     */
    public function __construct(SuccessStoryRepository $successStoryRepo)
    {
        $this->successStoryRepo = $successStoryRepo;
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|View
     *
     * @throws \Exception
     */
    public function index()
    {
        return view('admin.front-cms.success-story.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.front-cms.success-story.create');
    }

    /**
     * @param  CreateSuccessStoryRequest  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateSuccessStoryRequest $request)
    {
        $input = $request->all();
        $this->successStoryRepo->store($input);

        Flash::success('Success Story created successfully.');

        return redirect(route('success-stories.index'));
    }

    /**
     * @param  SuccessStory  $successStory
     * @return Application|Factory|View
     */
    public function edit(SuccessStory $successStory)
    {
        return view('admin.front-cms.success-story.edit', compact('successStory'));
    }

    /**
     * @param  UpdateStorySuccessRequest  $request
     * @param  SuccessStory  $successStory
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateStorySuccessRequest $request, SuccessStory $successStory)
    {
        $input = $request->all();
        $this->successStoryRepo->update($input, $successStory->id);

        Flash::success('Success Story updated successfully.');

        return redirect(route('success-stories.index'));
    }

    /**
     * @param  SuccessStory  $successStory
     * @return mixed
     */
    public function destroy(SuccessStory $successStory)
    {
        $successStory->delete();

        return $this->sendSuccess('Success Story deleted successfully.');
    }

    /**
     * @param  SuccessStory  $successStory
     * @return JsonResponse
     */
    public function show(SuccessStory $successStory)
    {
        return $this->sendResponse($successStory, 'Story Retrieved Successfully.');
    }
}
