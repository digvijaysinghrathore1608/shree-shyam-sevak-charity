<?php

namespace Database\Seeders;

use App\Models\SecondVideoSection;
use Illuminate\Database\Seeder;

class SecondVideoSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imageUrl = ('front_landing/web/media/avatars/150-26.jpg');

        if (! SecondVideoSection::where('key', 'short_title')->exists()) {
            SecondVideoSection::create(['key' => 'short_title', 'value' => 'Life Changing Video']);
        }

        if (! SecondVideoSection::where('key', 'title')->exists()) {
            SecondVideoSection::create(['key' => 'title', 'value' => 'Joel Orphanage Of Ministry Uganda']);
        }

        if (! SecondVideoSection::where('key', 'bg_image')->exists()) {
            SecondVideoSection::create(['key' => 'bg_image', 'value' => $imageUrl]);
        }

        if (! SecondVideoSection::where('key', 'youtube_video_link')->exists()) {
            SecondVideoSection::create([
                'key' => 'youtube_video_link',
                'value' => 'https://www.youtube.com/watch?v=QvkDDA62-tw&ab_channel=ComplexRealities',
            ]);
        }
    }
}
