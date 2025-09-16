<?php

namespace Database\Seeders;

use App\Models\SliderCard;
use Illuminate\Database\Seeder;

class SliderCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! SliderCard::where('key', 'title_1')->exists()) {
            SliderCard::create(['key' => 'title_1', 'value' => 'Trending Cause']);
        }

        if (! SliderCard::where('key', 'title_2')->exists()) {
            SliderCard::create(['key' => 'title_2', 'value' => 'Make A Support']);
        }

        if (! SliderCard::where('key', 'image')->exists()) {
            $image = 'front_landing/landing/img/home1/support_girl2.jpg';
            SliderCard::create(['key' => 'image', 'value' => $image]);
        }
    }
}
