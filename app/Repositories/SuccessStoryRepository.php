<?php

namespace App\Repositories;

use App\Models\SuccessStory;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class FrontSliderRepository
 */
class SuccessStoryRepository extends BaseRepository
{
    public array $fieldSearchable = [
        'title',
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
        return SuccessStory::class;
    }

    /**
     * @param $input
     * @return mixed
     */
    public function store($input)
    {
        try {
            DB::beginTransaction();

            $successStory = SuccessStory::create($input);

            if (isset($input['image']) && ! empty($input['image'])) {
                $successStory->addMedia($input['image'])->toMediaCollection(SuccessStory::SUCCESS_STORY_IMAGE);
            }

            DB::commit();

            return $successStory;
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

            $successStory = SuccessStory::find($id);
            $successStory->update($input);

            if (isset($input['image']) && ! empty($input['image'])) {
                $successStory->clearMediaCollection(SuccessStory::SUCCESS_STORY_IMAGE);
                $successStory->media()->delete();
                $successStory->addMedia($input['image'])->toMediaCollection(SuccessStory::SUCCESS_STORY_IMAGE);
            }

            DB::commit();

            return $successStory;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
