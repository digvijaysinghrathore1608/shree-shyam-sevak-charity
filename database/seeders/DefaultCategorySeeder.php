<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DefaultCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! Category::where('key', 'title_1')->exists()) {
            Category::create(['key' => 'title_1', 'value' => 'Healthy Foods']);
        }

        if (! Category::where('key', 'title_2')->exists()) {
            Category::create(['key' => 'title_2', 'value' => 'Make Donation']);
        }

        if (! Category::where('key', 'title_3')->exists()) {
            Category::create(['key' => 'title_3', 'value' => 'Medical Facilities']);
        }

        if (! Category::where('key', 'description_1')->exists()) {
            Category::create([
                'key' => 'description_1',
                'value' => 'There are only a few times in each of our lives that we get to witness a truly historic global compliment Ending smallpox,                  tearing',
            ]);
        }

        if (! Category::where('key', 'description_2')->exists()) {
            Category::create([
                'key' => 'description_2',
                'value' => 'There are only a few times in each of our lives that we get to witness a truly historic global compliment Ending smallpox, tearing',
            ]);
        }

        if (! Category::where('key', 'description_3')->exists()) {
            Category::create([
                'key' => 'description_3',
                'value' => 'There are only a few times in each of our lives that we get to witness a truly historic global compliment Ending smallpox,                 tearing',
            ]);
        }

        if (! Category::where('key', 'image_1')->exists()) {
            $imageUrl1 = asset('front_landing/landing/img/categories/box.png');
            Category::create(['key' => 'image_1', 'value' => $imageUrl1]);
        }

        if (! Category::where('key', 'image_2')->exists()) {
            $imageUrl2 = asset('front_landing/landing/img/categories/hand-love.png');
            Category::create(['key' => 'image_2', 'value' => $imageUrl2]);
        }

        if (! Category::where('key', 'image_3')->exists()) {
            $imageUrl3 = asset('front_landing/landing/img/categories/medical.png');
            Category::create(['key' => 'image_3', 'value' => $imageUrl3]);
        }
    }
}
