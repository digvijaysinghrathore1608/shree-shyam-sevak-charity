<?php

namespace App\Repositories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BrandRepository
 */
class BrandRepository extends BaseRepository
{
    public $fieldSearchable = [
        'name',
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
        return Brand::class;
    }

    /**
     * @param $input
     * @return mixed
     */
    public function store($input)
    {
        $brand = Brand::create($input);

        if (isset($input['image']) && ! empty($input['image'])) {
            $brand->addMedia($input['image'])->toMediaCollection(Brand::PATH, config('app.media_disc'));
        }

        return $brand;
    }

    /**
     * @param  array  $input
     * @param  int  $id
     * @return Builder|Builder[]|Collection|Model
     */
    public function update($input, $id)
    {
        $brand = Brand::findOrFail($id);

        /** @var Brand $brand */
        $brand->update($input);

        if (isset($input['image']) && ! empty($input['image'])) {
            $brand->clearMediaCollection(Brand::PATH);
            $brand->addMedia($input['image'])->toMediaCollection(Brand::PATH,
                config('app.media_disc'));
        }

        return $brand;
    }
}
