<?php

namespace App\Repositories;

use App\Models\FrontSliderThird;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class FrontSliderThirdRepository
 */
class FrontSliderThirdRepository extends BaseRepository
{
    public array $fieldSearchable = [
        'title_1',
        'title_2',
    ];

    /**
     * {@inheritDoc}
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * {@inheritDoc}
     */
    public function model(): string
    {
        return FrontSliderThird::class;
    }

    /**
     * @param $input
     * @return mixed
     */
    public function store($input)
    {
        try {
            DB::beginTransaction();

            $frontSlider = FrontSliderThird::create($input);

            if (isset($input['image']) && ! empty($input['image'])) {
                $frontSlider->addMedia($input['image'])->toMediaCollection(FrontSliderThird::FRONT_SLIDER_IMAGE);
            }

            DB::commit();

            return $frontSlider;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $input
     * @param $id
     * @return mixed
     */
    public function update($input, $id)
    {
        try {
            DB::beginTransaction();

            $frontSlider = FrontSliderThird::find($id);
            $frontSlider->update($input);

            if (isset($input['image']) && ! empty($input['image'])) {
                $frontSlider->clearMediaCollection(FrontSliderThird::FRONT_SLIDER_IMAGE);
                $frontSlider->media()->delete();
                $frontSlider->addMedia($input['image'])->toMediaCollection(FrontSliderThird::FRONT_SLIDER_IMAGE);
            }

            DB::commit();

            return $frontSlider;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
