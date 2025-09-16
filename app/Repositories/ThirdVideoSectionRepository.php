<?php

namespace App\Repositories;

use App\Models\ThirdVideoSection;

/**
 * Class ThirdVideoSectionRepository
 */
class ThirdVideoSectionRepository extends BaseRepository
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
        return ThirdVideoSection::class;
    }

    /**
     * @param  array  $input
     * @return void
     */
    public function updateData($input)
    {
        foreach ($input as $key => $value) {
            /** @var THirdVideoSection $thirdVideoSection */
            $thirdVideoSection = ThirdVideoSection::where('key', $key)->first();
            if (! $thirdVideoSection) {
                continue;
            }
            if (in_array($key, ['bg_image'])) {
                $this->fileUpload($thirdVideoSection, $value);
                continue;
            }
            $thirdVideoSection->update(['value' => $value]);
        }
    }

    /**
     * @param $thirdVideoSection
     * @param $file
     */
    public function fileUpload($thirdVideoSection, $file)
    {
        $thirdVideoSection->clearMediaCollection(ThirdVideoSection::VIDEO_SECTION_PATH);
        $media = $thirdVideoSection->addMedia($file)->toMediaCollection(ThirdVideoSection::VIDEO_SECTION_PATH,
            config('app.media_disc'));
        $thirdVideoSection->update(['value' => $media->getFullUrl()]);
    }
}
