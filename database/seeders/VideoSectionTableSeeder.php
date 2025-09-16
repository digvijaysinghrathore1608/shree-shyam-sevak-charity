<?php

namespace Database\Seeders;

use App\Models\VideoSection;
use Illuminate\Database\Seeder;

class VideoSectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! VideoSection::where('key', 'short_title')->exists()) {
            VideoSection::create(['key' => 'short_title', 'value' => 'Life Changing Video']);
        }

        if (! VideoSection::where('key', 'title')->exists()) {
            VideoSection::create(['key' => 'title', 'value' => 'Joel Orphanage Of Ministry Uganda']);
        }

        if (! VideoSection::where('key', 'bg_image')->exists()) {
            $imageUrl = ('front_landing/web/media/avatars/150-26.jpg');
            VideoSection::create(['key' => 'bg_image', 'value' => $imageUrl]);
        }

        if (! VideoSection::where('key', 'youtube_video_link')->exists()) {
            VideoSection::create([
                'key' => 'youtube_video_link',
                'value' => 'https://www.youtube.com/watch?v=QvkDDA62-tw&ab_channel=ComplexRealities',
            ]);
        }
    }
}
