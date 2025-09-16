<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNewsTagsRequest;
use App\Http\Requests\UpdateNewsTagsRequest;
use App\Models\News;
use App\Repositories\NewsTagsRepository;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Response;

class NewsTagsController extends AppBaseController
{
    /** @var NewsTagsRepository */
    private $newsTagsRepository;

    public function __construct(NewsTagsRepository $newsTagsRepo)
    {
        $this->newsTagsRepository = $newsTagsRepo;
    }

    /**
     * Display a listing of the NewsTags.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index()
    {
        return view('admin.news_tags.index');
    }

    /**
     * Show the form for creating a new NewsTags.
     *
     * @return Response
     */
    public function create()
    {
//        return view('news_tags.create');
    }

    /**
     * Store a newly created NewsTags in storage.
     *
     * @param  CreateNewsTagsRequest  $request
     * @return Response
     */
    public function store(CreateNewsTagsRequest $request)
    {
        $input = $request->all();

        $newsTags = $this->newsTagsRepository->create($input);

        return $this->sendSuccess('News Tags saved successfully.');
    }

    /**
     * Display the specified NewsTags.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $newsTags = $this->newsTagsRepository->find($id);

        if (empty($newsTags)) {
            Flash::error('News Tags not found');

            return redirect(route('newsTags.index'));
        }

        return view('news_tags.show')->with('newsTags', $newsTags);
    }

    /**
     * Show the form for editing the specified NewsTags.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $newsTags = $this->newsTagsRepository->find($id);

        if (empty($newsTags)) {
            return $this->sendError('News Tags not found');
        }

        return $this->sendResponse($newsTags, 'News Tags retrieved successfully');
    }

    /**
     * Update the specified NewsTags in storage.
     *
     * @param  UpdateNewsTagsRequest  $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateNewsTagsRequest $request, $id)
    {
        $newsTags = $this->newsTagsRepository->find($id);

        if (empty($newsTags)) {
            Flash::error('News Tags not found');

            return redirect(route('news-tags.index '));
        }

        $newsTags = $this->newsTagsRepository->update($request->all(), $id);

        return $this->sendSuccess('News Tags updated successfully.');
    }

    /**
     * Remove the specified NewsTags from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $newsTagsCount = News::whereHas('newsTags.news', function (Builder $q) use ($id) {
            $q->where('news_tags_id', $id);
        })->get();

        if ($newsTagsCount->count() > 0) {
            return   $this->sendError('News Tags can\'t be deleted');
        }

        $newsTags = $this->newsTagsRepository->find($id);

        $newsTags->delete();

        return $this->sendSuccess('News Tags deleted successfully.');
    }
}
