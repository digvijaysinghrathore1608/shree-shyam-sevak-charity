<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateNewsCommentsRequest;
use App\Models\NewsComment;
use App\Repositories\NewsCommentsRepository;
use Illuminate\Http\Request;

class NewsCommentsController extends AppBaseController
{
    /**
     * @var NewsCommentsRepository
     */
    public $newsCommentsRepo;

    /**
     * @param  NewsCommentsRepository  $newsCommentsRepository
     */
    public function __construct(NewsCommentsRepository $newsCommentsRepository)
    {
        $this->newsCommentsRepo = $newsCommentsRepository;
    }

    /**
     * @param  NewsComment  $newsComment
     * @return mixed
     */
    public function edit(NewsComment $newsComment)
    {
        return $this->sendResponse($newsComment, 'News Comments retrieved successfully.');
    }

    /**
     * @param  Request  $request
     * @param  NewsComment  $newsComment
     * @return mixed
     */
    public function update(UpdateNewsCommentsRequest $request, NewsComment $newsComment)
    {
        $input = $request->all();

        $this->newsCommentsRepo->update($input, $newsComment->id);

        return $this->sendSuccess('Comment updated successfully.');
    }

    /**
     * @param  NewsComment  $newsComment
     * @return mixed
     */
    public function destroy(NewsComment $newsComment)
    {
        $newsComment->delete();

        return $this->sendSuccess('Comment deleted successfully.');
    }
}
