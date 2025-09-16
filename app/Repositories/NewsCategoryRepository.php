<?php

namespace App\Repositories;

use App\Models\NewsCategory;

/**
 * Class NewsCategoryRepository
 *
 * @version February 11, 2022, 9:22 am UTC
 */
class NewsCategoryRepository extends BaseRepository
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
        return NewsCategory::class;
    }
}
