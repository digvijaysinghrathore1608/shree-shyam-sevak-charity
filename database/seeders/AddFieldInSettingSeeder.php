<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class AddFieldInSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! Setting::where('key', 'donation_commission')->exists()) {
            Setting::create([
                'key' => 'donation_commission',
                'value' => '0',
            ]);
        }
    }
}
