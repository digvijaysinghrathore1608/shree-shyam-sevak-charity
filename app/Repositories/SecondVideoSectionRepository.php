<?php

namespace App\Repositories;

use App\Models\SecondVideoSection;

/**
 * Class SecondVideoSectionRepository
 */
class SecondVideoSectionRepository extends BaseRepository
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
        return SecondVideoSection::class;
    }

    /**
     * @param  array  $input
     * @return void
     */
    public function updateData($input)
    {
        foreach ($input as $key => $value) {
            /** @var SecondVideoSection $secondVideoSection */
            $secondVideoSection = SecondVideoSection::where('key', $key)->first();
            if (! $secondVideoSection) {
                continue;
            }
            if (in_array($key, ['bg_image'])) {
                $this->fileUpload($secondVideoSection, $value);
                continue;
            }
            $secondVideoSection->update(['value' => $value]);
        }
    }

    /**
     * @param $secondVideoSection
     * @param $file
     */
    public function fileUpload($secondVideoSection, $file)
    {
        $secondVideoSection->clearMediaCollection(SecondVideoSection::VIDEO_SECTION_PATH);
        $media = $secondVideoSection->addMedia($file)->toMediaCollection(SecondVideoSection::VIDEO_SECTION_PATH,
            config('app.media_disc'));
        $secondVideoSection->update(['value' => $media->getFullUrl()]);
    }
}
