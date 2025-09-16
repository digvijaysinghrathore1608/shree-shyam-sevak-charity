<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsTags;
use App\Repositories\NewsRepository;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Response;

class NewsController extends AppBaseController
{
    /** @var NewsRepository */
    private $newsRepository;

    public function __construct(NewsRepository $newsRepo)
    {
        $this->newsRepository = $newsRepo;
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|View
     *
     * @throws \Exception
     */
    public function index()
    {
        return view('admin.news.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $newsCategory = NewsCategory::pluck('name', 'id')->toArray();

        $newsTags = NewsTags::pluck('name', 'id')->toArray();

        return view('admin.news.create', compact('newsCategory', 'newsTags'));
    }

    /**
     * @param  CreateNewsRequest  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateNewsRequest $request)
    {
        $input = $request->all();

        $news = $this->newsRepository->store($input);

        Flash::success('News saved successfully.');

        return redirect(route('news.index'));
    }

    /**
     * @param $id
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function edit($id)
    {
        $news = $this->newsRepository->find($id);

        $tags = $news->newsTags()->pluck('news_tags_id')->toArray();
        if (empty($news)) {
            Flash::error('News not found');

            return redirect(route('news.index'));
        }
        $newsCategory = NewsCategory::pluck('name', 'id')->toArray();

        $newsTags = NewsTags::pluck('name', 'id')->toArray();

        return view('admin.news.edit', compact('newsCategory', 'newsTags', 'tags', 'news'));
    }

    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    /**
     * @param $id
     * @param  UpdateNewsRequest  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update($id, UpdateNewsRequest $request)
    {
        $news = $this->newsRepository->find($id);

        if (empty($news)) {
            Flash::error('News not found');

            return redirect(route('news.index'));
        }

        $news = $this->newsRepository->update($request->all(), $id);

        Flash::success('News updated successfully.');

        return redirect(route('news.index'));
    }

    /**
     * Remove the specified News from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $news = $this->newsRepository->find($id);

        $news->delete();

        return $this->sendSuccess('News deleted successfully.');
    }
}
