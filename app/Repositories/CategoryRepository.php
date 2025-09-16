<?php

namespace App\Repositories;

use App\Models\Category;

/**
 * Class CategoryRepository
 */
class CategoryRepository extends BaseRepository
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
        return Category::class;
    }

    /**
     * @param  array  $input
     * @return void
     */
    public function updateData(array $input)
    {
        foreach ($input as $key => $value) {
            /** @var Category $category */
            $category = Category::where('key', $key)->first();
            if (! $category) {
                continue;
            }
            if (in_array($key, ['image_1', 'image_2', 'image_3'])) {
                $this->fileUpload($category, $value);
                continue;
            }
            $category->update(['value' => $value]);
        }
    }

    /**
     * @param $category
     * @param $file
     */
    public function fileUpload($category, $file)
    {
        $category->clearMediaCollection(Category::PATH);
        $media = $category->addMedia($file)->toMediaCollection(Category::PATH, config('app.media_disc'));
        $category->update(['value' => $media->getFullUrl()]);
    }
}
