<?php

namespace App\Repositories;

use App\Models\CategoryThird;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Yajra\DataTables\Exceptions\Exception;

/**
 * Class CategoryThirdRepository
 */
class CategoryThirdRepository extends BaseRepository
{
    public $fieldSearchable = [
        'key',
        'value',
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
        return CategoryThird::class;
    }

    /**
     * @param $input
     * @return mixed
     */
    public function store($input)
    {
        try {
            DB::beginTransaction();

            $thirdCategory = CategoryThird::create($input);

            if (isset($input['image']) && ! empty($input['image'])) {
                $thirdCategory->addMedia($input['image'])->toMediaCollection(CategoryThird::PATH);
            }

            DB::commit();

            return $thirdCategory;
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
        $categoryThird = CategoryThird::findOrFail($id);

        $categoryThird->update($input);

        if (isset($input['image']) && ! empty($input['image'])) {
            $categoryThird->clearMediaCollection(CategoryThird::PATH);
            $categoryThird->addMedia($input['image'])->toMediaCollection(CategoryThird::PATH,
                config('app.media_disc'));
        }

        return $categoryThird;
    }

    /**
     * @param $category
     * @param $file
     */
    public function fileUpload($category, $file)
    {
        $category->clearMediaCollection(CategoryThird::PATH);
        $media = $category->addMedia($file)->toMediaCollection(CategoryThird::PATH, config('app.media_disc'));
        $category->update(['value' => $media->getFullUrl()]);
    }
}
