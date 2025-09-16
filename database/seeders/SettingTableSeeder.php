<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! Setting::where('key', 'application_name')->exists()) {
            Setting::create(['key' => 'application_name', 'value' => 'InfyFunding']);
        }
        if (! Setting::where('key', 'app_logo')->exists()) {
            $imageUrlLogo = 'front_landing/images/funding-logo.png';
            Setting::create(['key' => 'app_logo', 'value' => $imageUrlLogo]);
        }
        if (! Setting::where('key', 'app_favicon')->exists()) {
            $imageUrlFavicon = 'front_landing/images/funding-logo.png';
            Setting::create(['key' => 'app_favicon', 'value' => $imageUrlFavicon]);
        }
        if (! Setting::where('key', 'email')->exists()) {
            Setting::create(['key' => 'email', 'value' => 'metrnonics@gmail.com']);
        }
        if (! Setting::where('key', 'prefix_code')->exists()) {
            Setting::create(['key' => 'prefix_code', 'value' => '91']);
        }
        if (! Setting::where('key', 'phone')->exists()) {
            Setting::create(['key' => 'phone', 'value' => '9876543210']);
        }
        if (! Setting::where('key', 'address')->exists()) {
            Setting::create(['key' => 'address', 'value' => 'Mota Varachha, Surat, Gujarat']);
        }
        if (! Setting::where('key', 'about_us')->exists()) {
            Setting::create([
                'key' => 'about_us',
                'value' => 'Elit aenean, amet eros curabitur. Wisi ad eget ipsum metus sociis Cras enim wisi elit aenean.',
            ]);
        }
        if (! Setting::where('key', 'active_homepage_status')->exists()) {
            Setting::create(['key' => 'active_homepage_status', 'value' => '1']);
        }

        if (! Setting::where('key', 'terms_conditions')->exists()) {
            $termConditionHtml = view('admin.front-cms.terms-conditions.terms_conditions')->render();
            Setting::create(['key' => 'terms_conditions', 'value' => $termConditionHtml]);
        }

        if (! Setting::where('key', 'privacy_policy')->exists()) {
            $privacyPolicyHtml = view('admin.front-cms.terms-conditions.privacy_policy')->render();
            Setting::create(['key' => 'privacy_policy', 'value' => $privacyPolicyHtml]);
        }
    }
}
