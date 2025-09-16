<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Seeder;

class AboutUsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! AboutUs::where('key', 'menu_title')->exists()) {
            AboutUs::create(['key' => 'menu_title', 'value' => 'Our Mission: Food, Education, Medicine']);
        }

        if (! AboutUs::where('key', 'menu_bg_image')->exists()) {
            $imageUrl1 = ('front_landing/images/about-hero-img.png');
            AboutUs::create(['key' => 'menu_bg_image', 'value' => $imageUrl1]);
        }

        if (! AboutUs::where('key', 'title')->exists()) {
            AboutUs::create(['key' => 'title', 'value' => 'We Have Funded 44k Dollars Over']);
        }

        if (! AboutUs::where('key', 'short_description')->exists()) {
            AboutUs::create(['key' => 'short_description', 'value' => 'We have plenty of water of drink even.']);
        }

        if (! AboutUs::where('key', 'image_1')->exists()) {
            $imageUrl3 = ('front_landing/images/about-us2.png');
            AboutUs::create(['key' => 'image_1', 'value' => $imageUrl3]);
        }

        if (! AboutUs::where('key', 'image_2')->exists()) {
            $imageUrl2 = ('front_landing/images/about-us1.png');
            AboutUs::create(['key' => 'image_2', 'value' => $imageUrl2]);
        }

        if (! AboutUs::where('key', 'point_1')->exists()) {
            AboutUs::create(['key' => 'point_1', 'value' => 'A place in history.']);
        }

        if (! AboutUs::where('key', 'point_2')->exists()) {
            AboutUs::create(['key' => 'point_2', 'value' => 'Its about impact, goodness.']);
        }

        if (! AboutUs::where('key', 'point_3')->exists()) {
            AboutUs::create(['key' => 'point_3', 'value' => 'More goodness in the world.']);
        }

        if (! AboutUs::where('key', 'point_4')->exists()) {
            AboutUs::create(['key' => 'point_4', 'value' => 'The world we live in right now can be hard.']);
        }

        if (! AboutUs::where('key', 'years_of_exp')->exists()) {
            AboutUs::create(['key' => 'years_of_exp', 'value' => '25']);
        }
    }
}
