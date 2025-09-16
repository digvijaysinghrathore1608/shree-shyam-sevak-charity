<?php

namespace App\Repositories;

use App\Models\FrontSlider;
use App\Models\SliderCard;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class FrontSliderRepository
 */
class FrontSliderRepository extends BaseRepository
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
        return FrontSlider::class;
    }

    /**
     * @param $input
     * @return mixed
     */
    public function store($input)
    {
        try {
            DB::beginTransaction();

            $frontSlider = FrontSlider::create($input);

            if (isset($input['image']) && ! empty($input['image'])) {
                $frontSlider->addMedia($input['image'])->toMediaCollection(FrontSlider::FRONT_SLIDER_IMAGE);
            }

            DB::commit();

            return $frontSlider;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     * @return void
     */
    public function updateData(array $input)
    {
        foreach ($input as $key => $value) {
            /** @var SliderCard $sliderCard */
            $sliderCard = SliderCard::where('key', $key)->first();
            if (! $sliderCard) {
                continue;
            }
            if (in_array($key, ['image'])) {
                $this->fileUpload($sliderCard, $value);
                continue;
            }
            $sliderCard->update(['value' => $value]);
        }
    }

    /**
     * @param $sliderCard
     * @param $file
     */
    public function fileUpload($sliderCard, $file)
    {
        $sliderCard->clearMediaCollection(SliderCard::PATH);
        $media = $sliderCard->addMedia($file)->toMediaCollection(SliderCard::PATH, config('app.media_disc'));
        $sliderCard->update(['value' => $media->getFullUrl()]);
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

            $frontSlider = FrontSlider::find($id);
            $frontSlider->update($input);

            if (isset($input['image']) && ! empty($input['image'])) {
                $frontSlider->clearMediaCollection(FrontSlider::FRONT_SLIDER_IMAGE);
                $frontSlider->media()->delete();
                $frontSlider->addMedia($input['image'])->toMediaCollection(FrontSlider::FRONT_SLIDER_IMAGE);
            }

            DB::commit();

            return $frontSlider;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
