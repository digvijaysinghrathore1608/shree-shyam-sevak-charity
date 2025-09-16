<?php

namespace Database\Seeders;

use App\Models\ContactUs;
use Illuminate\Database\Seeder;

class ContactUsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! ContactUs::where('key', 'menu_title')->exists()) {
            ContactUs::create(['key' => 'menu_title', 'value' => 'Our Mission: Food, Education']);
        }

        if (! ContactUs::where('key', 'menu_image')->exists()) {
            $imageUrl = asset('front_landing/images/causes-hero-img.png');
            ContactUs::create(['key' => 'menu_image', 'value' => $imageUrl]);
        }
    }
}
