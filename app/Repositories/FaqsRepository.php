<?php

namespace App\Repositories;

use App\Models\Faqs;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FaqsRepository
 */
class FaqsRepository extends BaseRepository
{
    public $fieldSearchable = [
        'title',
        'description',
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
        return Faqs::class;
    }

    /**
     * @param $input
     * @return mixed
     */
    public function store($input)
    {
        $faqs = Faqs::create($input);

        return $faqs;
    }

    /**
     * @param  array  $input
     * @param  int  $id
     * @return Builder|Builder[]|Collection|Model
     */
    public function update($input, $id)
    {
        $faqs = Faqs::findOrFail($id);

        $faqs->update($input);

        return $faqs;
    }
}
