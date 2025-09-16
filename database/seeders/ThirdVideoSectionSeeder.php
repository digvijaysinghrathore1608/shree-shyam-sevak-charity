<?php

namespace Database\Seeders;

use App\Models\ThirdVideoSection;
use Illuminate\Database\Seeder;

class ThirdVideoSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! ThirdVideoSection::where('key', 'short_title')->exists()) {
            ThirdVideoSection::create(['key' => 'short_title', 'value' => 'Life Changing Video']);
        }

        if (! ThirdVideoSection::where('key', 'title')->exists()) {
            ThirdVideoSection::create(['key' => 'title', 'value' => 'Joel Orphanage Of Ministry Uganda']);
        }

        if (! ThirdVideoSection::where('key', 'bg_image')->exists()) {
            $imageUrl = asset('front_landing/images/video-img.png');
            ThirdVideoSection::create(['key' => 'bg_image', 'value' => $imageUrl]);
        }

        if (! ThirdVideoSection::where('key', 'youtube_video_link')->exists()) {
            ThirdVideoSection::create([
                'key' => 'youtube_video_link',
                'value' => 'https://www.youtube.com/watch?v=QvkDDA62-tw&ab_channel=ComplexRealities',
            ]);
        }
    }
}
