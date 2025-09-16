<?php

namespace App\Repositories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CountryRepository
 */
class CountryRepository extends BaseRepository
{
    public $fieldSearchable = [
        'country_name',
    ];

    /**
     * {@inheritDoc}
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * {@inheritDoc}
     */
    public function model()
    {
        return Country::class;
    }

    /**
     * @param $input
     * @return mixed
     */
    public function store($input)
    {
        $country = Country::create($input);

        return $country;
    }

    /**
     * @param $input
     * @param $id
     * @return Country|Builder|Builder[]|Collection|Model
     */
    public function update($input, $id)
    {
        $country = Country::findOrFail($id);

        /** @var Country $country */
        $country->update($input);

        return $country;
    }
}
