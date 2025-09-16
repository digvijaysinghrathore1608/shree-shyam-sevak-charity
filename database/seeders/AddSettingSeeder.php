<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class AddSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! Setting::where('key', 'youtube_url')->exists()) {
            Setting::create(['key' => 'youtube_url', 'value' => 'https://www.youtube.com/infyom/']);
        }

        if (! Setting::where('key', 'pinterest_url')->exists()) {
            Setting::create(['key' => 'pinterest_url', 'value' => 'https://www.pinterest.com/infyom/']);
        }
        if (! Setting::where('key', 'twitter_url')->exists()) {
            Setting::create(['key' => 'twitter_url', 'value' => 'https://www.twitter.com/infyom/']);
        }

        if (! Setting::where('key', 'instagram_url')->exists()) {
            Setting::create(['key' => 'instagram_url', 'value' => 'https://www.instagram.com/infyom/']);
        }

        if (! Setting::where('key', 'facebook_url')->exists()) {
            Setting::create(['key' => 'facebook_url', 'value' => 'https://www.facebook.com/infyom/']);
        }

        if (! Setting::where('key', 'linkedin_url')->exists()) {
            Setting::create(['key' => 'linkedin_url', 'value' => 'https://www.linkedin.com/infyom/']);
        }
    }
}
