<?php

namespace App\Repositories;

use App\Models\FrontSlider2;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class FrontSlider2Repository
 */
class FrontSlider2Repository extends BaseRepository
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
        return FrontSlider2::class;
    }

    /**
     * @param $input
     * @return mixed
     */
    public function store($input)
    {
        try {
            DB::beginTransaction();

            $frontSlider = FrontSlider2::create($input);

            if (isset($input['image']) && ! empty($input['image'])) {
                $frontSlider->addMedia($input['image'])->toMediaCollection(FrontSlider2::FRONT_SLIDER_IMAGE);
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

            $frontSlider = FrontSlider2::find($id);
            $frontSlider->update($input);

            if (isset($input['image']) && ! empty($input['image'])) {
                $frontSlider->clearMediaCollection(FrontSlider2::FRONT_SLIDER_IMAGE);
                $frontSlider->media()->delete();
                $frontSlider->addMedia($input['image'])->toMediaCollection(FrontSlider2::FRONT_SLIDER_IMAGE);
            }

            DB::commit();

            return $frontSlider;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
