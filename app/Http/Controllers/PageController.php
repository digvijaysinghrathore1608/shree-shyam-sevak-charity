<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Page;
use App\Repositories\PageRepository;
use Illuminate\Console\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use League\Flysystem\Exception;

class PageController extends AppBaseController
{
    /**
     * @var PageRepository
     */
    public PageRepository $pageRepo;

    /**
     * @param  PageRepository  $pageRepository
     */
    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepo = $pageRepository;
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|View
     *
     * @throws Exception
     * @throws \Exception
     */
    public function index()
    {
        return view('admin.pages.index');
    }

    /**
     * @return Factory|\Illuminate\Contracts\Foundation\Application|View
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * @param  CreatePageRequest  $request
     * @return JsonResponse
     */
    public function store(CreatePageRequest $request)
    {
        $input = $request->all();
        $input['is_active'] = (isset($input['is_active'])) ? 1 : 0;
        $this->pageRepo->create($input);
        Flash::success('Page created successfully.');

        return redirect(route('pages.index'));
    }

    /**
     * @return Application|Factory|View
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * @param  UpdatePageRequest  $request
     * @param  Page  $page
     * @return JsonResponse
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        $input = $request->all();
        $input['is_active'] = (isset($input['is_active'])) ? 1 : 0;
        $this->pageRepo->update($input, $page->id);
        Flash::success('Page updated successfully.');

        return redirect(route('pages.index'));
    }

    /**
     * @param  Page  $page
     * @return JsonResponse
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return $this->sendSuccess('Page deleted successfully.');
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function changePageStatus(Request $request): JsonResponse
    {
        $page = Page::findOrFail($request->get('id'));
        $page->is_active = ($page->is_active == 0) ? '1' : '0';
        $page->save();

        return $this->sendResponse($page, 'Status updated successfully.');
    }

    /**
     * @param  Page  $page
     *  @return Application|Factory|View
     */
    public function pageDetail(Page $page)
    {
        if ($page->is_active == Page::INACTIVE){
            return redirect(route('landing.home'));
        }
        
        return view('front_landing.page_detail', compact('page'));
    }

    /**
     * @param  Page  $page
     * @return JsonResponse
     */
    public function show(Page $page)
    {
        return $this->sendResponse($page, 'Inquiry Retrieved Successfully.');
    }
}
