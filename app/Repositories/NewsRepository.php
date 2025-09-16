<?php

namespace App\Repositories;

use App\Models\News;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NewsRepository
 *
 * @version February 12, 2022, 7:49 am UTC
 */
class NewsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'slug',
        'news_category_id',
        'description',
        'added_by',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return News::class;
    }

    /**
     * @param $input
     * @return mixed
     */
    public function store($input)
    {
        $news = News::create($input);

        if (! empty($input['tags'])) {
            $news->newsTags()->sync($input['tags']);
        }

        if (isset($input['image']) && ! empty($input['image'])) {
            $news->addMedia($input['image'])->toMediaCollection(News::PATH, config('app.media_disc'));
        }

        return $news;
    }

    /**
     * @param  array  $input
     * @param  int  $id
     * @return Builder|Builder[]|Collection|Model
     */
    public function update($input, $id)
    {
        $news = News::findOrFail($id);

        $news->newsTags()->sync($input['tags']);

        $news->update($input);

        if (isset($input['image']) && ! empty($input['image'])) {
            $news->clearMediaCollection(News::PATH);
            $news->addMedia($input['image'])->toMediaCollection(News::PATH,
                config('app.media_disc'));
        }

        return $news;
    }
}
