<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->request->get('sectionName') == 'contact-informations') {
            return [
                'address' => 'required',
            ];
        }
        if ($this->request->get('sectionName') == 'social-settings') {
            return [
                'facebook_url' => 'required',
                'twitter_url' => 'required',
                'youtube_url' => 'required',
                'pinterest_url' => 'required',
                'linkedin_url' => 'required',
                'instagram_url' => 'required',
            ];
        }

        if ($this->request->get('sectionName') == 'generals') {
            return [
                'application_name' => 'required|string|max:30',
                'email' => 'required|email:filter',
                'app_logo' => 'nullable|mimes:jpg,jpeg,png',
                'app_favicon' => 'nullable|mimes:jpg,jpeg,png',
                'phone' => 'required',
                'about_us' => 'required',
            ];
        }

        if ($this->request->get('sectionName') == 'homepages') {
            return [
                //
            ];
        }
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'country_id.required' => 'Country field is required.',
            'state_id.required' => 'State field is required.',
            'city_id.required' => 'City field is required.',
            'address_one.required' => 'Address 1 field is required.',
            'address_two.required' => 'Address 2 field is required.',
            'facebook_url.required' => 'Facebook URL field is required',
            'twitter_url.required' => 'Twitter URL field is required',
            'youtube_url.required' => 'Youtube URL field is required',
            'pinterest_url.required' => 'Pinterest URL field is required',
            'linkedin_url.required' => 'Linkedin URL field is required',
            'instagram_url.required' => 'Instagram URL field is required',
        ];
    }
}
