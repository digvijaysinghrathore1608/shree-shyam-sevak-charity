<?php

namespace App\Repositories;

use App\Models\NewsTags;

/**
 * Class NewsTagsRepository
 *
 * @version February 10, 2022, 10:05 am UTC
 */
class NewsTagsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
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
        return NewsTags::class;
    }
}
