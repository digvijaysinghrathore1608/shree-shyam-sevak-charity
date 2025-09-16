<?php

namespace App\Repositories;

use App\Models\NewsComment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NewsCommentsRepository
 */
class NewsCommentsRepository extends BaseRepository
{
    public $fieldSearchable = [
        'comments',
        'name',
        'email',
        'website_name',
        'news_id',
        'user_id',
    ];

    /**
     * @return array|string[]
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * @return string
     */
    public function model()
    {
        return NewsComment::class;
    }

    /**
     * @param  array  $input
     * @param  int  $id
     * @return Builder|Builder[]|Collection|Model
     */
    public function update($input, $id)
    {
        $newsComments = NewsComment::findOrFail($id);

        $newsComments->update($input);

        return $newsComments;
    }
}
