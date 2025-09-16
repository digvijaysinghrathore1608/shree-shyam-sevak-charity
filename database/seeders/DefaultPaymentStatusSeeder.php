<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class DefaultPaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! Setting::where('key', 'stripe_enable')->exists()) {
            Setting::create(['key' => 'stripe_enable', 'value' => 0]);
        }

        if (! Setting::where('key', 'paypal_enable')->exists()) {
            Setting::create(['key' => 'paypal_enable', 'value' => 0]);
        }
    }
}
