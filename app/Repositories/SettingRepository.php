<?php

namespace App\Repositories;

use App\Models\Setting;
use Illuminate\Support\Arr;

/**
 * Class UserRepository
 */
class SettingRepository extends BaseRepository
{
    public $fieldSearchable = [
        'application_name',
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
        return Setting::class;
    }

    /**
     * @param  array  $input
     * @return void
     */
    public function update($input, $userId)
    {
        if ($input['sectionName'] == 'contact-informations') {
        }

        $inputArr = Arr::except($input, ['_token']);
        foreach ($inputArr as $key => $value) {
            /** @var Setting $setting */
            $setting = Setting::where('key', $key)->first();
            if (! $setting || ! $value) {
                continue;
            }

            if ($inputArr['sectionName'] == 'generals') {
                $inputArr['phone'] = '+'.$inputArr['prefix_code'].$inputArr['phone'];

                if (in_array($key, ['app_logo', 'app_favicon'])) {
                    $this->fileUpload($setting, $value);
                    continue;
                }
            }

            if (! $setting) {
                continue;
            }

            $setting->update(['value' => $value]);
        }
    }

    /**
     * @param $input
     */
    public function updateSettingCredential($input)
    {
        $inputArr = Arr::except($input, ['_token', 'sectionName']);

        foreach ($inputArr as $key => $value) {
            /** @var Setting $setting */
            $setting = Setting::where('key', $key)->first();
            if (! $setting) {
                Setting::create([
                    'key' => $key,
                    'value' => $value,
                ]);
            } else {
                $setting->update(['value' => $value]);
            }
        }
    }

    /**
     * @param $setting
     * @param $file
     */
    public function fileUpload($setting, $file)
    {
        $setting->clearMediaCollection(Setting::PATH);
        $media = $setting->addMedia($file)->toMediaCollection(Setting::PATH, config('app.media_disc'));
        $setting->update(['value' => $media->getFullUrl()]);
    }

    /**
     * @param $input
     */
    public function updateData($input)
    {
        foreach ($input as $key => $value) {
            /** @var Setting $termsConditions */
            $termsConditions = Setting::where('key', $key)->first();
            if (! $termsConditions) {
                continue;
            }
            $termsConditions->update(['value' => $value]);
        }
    }
}
