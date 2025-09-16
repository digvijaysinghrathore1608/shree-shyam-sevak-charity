<?php

namespace App\Repositories;

use App\Models\AboutUs;

/**
 * Class AboutUsRepository
 */
class AboutUsRepository extends BaseRepository
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
        return AboutUs::class;
    }

    /**
     * @param  array  $input
     * @return void
     */
    public function updateData($input)
    {
        foreach ($input as $key => $value) {
            /** @var AboutUs $about_us */
            $about_us = AboutUs::where('key', $key)->first();
            if (! $about_us) {
                continue;
            }
            if (in_array($key, ['menu_bg_image', 'image_1', 'image_2'])) {
                $this->fileUpload($about_us, $value);
                continue;
            }
            $about_us->update(['value' => $value]);
        }
    }

    /**
     * @param $about_us
     * @param $file
     */
    public function fileUpload($about_us, $file)
    {
        $about_us->clearMediaCollection(AboutUs::ABOUT_US_PATH);
        $media = $about_us->addMedia($file)->toMediaCollection(AboutUs::ABOUT_US_PATH, config('app.media_disc'));
        $about_us->update(['value' => $media->getFullUrl()]);
    }
}
