<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\Withdrawal;
use Illuminate\Database\Seeder;

class AddChargesTypeFieldSettingTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! Setting::where('key', 'charges_type')->exists()) {
            Setting::create(['key' => 'charges_type', 'value' => Withdrawal::PERCENTAGE]);
        }
    }
}
