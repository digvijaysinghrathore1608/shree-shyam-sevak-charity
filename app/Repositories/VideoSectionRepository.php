<?php

namespace App\Repositories;

use App\Models\VideoSection;

/**
 * Class VideoSectionRepository
 */
class VideoSectionRepository extends BaseRepository
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
        return VideoSection::class;
    }

    /**
     * @param  array  $input
     * @return void
     */
    public function updateData($input)
    {
        foreach ($input as $key => $value) {
            /** @var VideoSection $videoSection */
            $videoSection = VideoSection::where('key', $key)->first();
            if (! $videoSection) {
                continue;
            }
            if (in_array($key, ['bg_image'])) {
                $this->fileUpload($videoSection, $value);
                continue;
            }
            $videoSection->update(['value' => $value]);
        }
    }

    /**
     * @param $videoSection
     * @param $file
     */
    public function fileUpload($videoSection, $file)
    {
        $videoSection->clearMediaCollection(VideoSection::VIDEO_SECTION_PATH);
        $media = $videoSection->addMedia($file)->toMediaCollection(VideoSection::VIDEO_SECTION_PATH,
            config('app.media_disc'));
        $videoSection->update(['value' => $media->getFullUrl()]);
    }
}
