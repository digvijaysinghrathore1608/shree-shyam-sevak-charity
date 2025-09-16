<?php

namespace App\Repositories;

use App\Models\ContactUs;

/**
 * Class ContactUsRepository
 */
class ContactUsRepository extends BaseRepository
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
        return ContactUs::class;
    }

    /**
     * @param  array  $input
     * @return void
     */
    public function updateData($input)
    {
        foreach ($input as $key => $value) {
            /** @var ContactUs $contactUs */
            $contactUs = ContactUs::where('key', $key)->first();
            if (! $contactUs) {
                continue;
            }
            if ($key == 'menu_image') {
                $this->fileUpload($contactUs, $value);
                continue;
            }
            $contactUs->update(['value' => $value]);
        }
    }

    /**
     * @param $contactUs
     * @param $file
     */
    public function fileUpload($contactUs, $file)
    {
        $contactUs->clearMediaCollection(ContactUs::CONTACT_US_PATH);
        $media = $contactUs->addMedia($file)->toMediaCollection(ContactUs::CONTACT_US_PATH, config('app.media_disc'));
        $contactUs->update(['value' => $media->getFullUrl()]);
    }
}
