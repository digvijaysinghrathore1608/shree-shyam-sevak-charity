<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsTags;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DefaultNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();

            $userId = User::where('email', 'admin@infyfund.com')->first();
            $news1 = News::create([
                'title' => 'Save the Children Role in Fight Against Malnutrition Hailed',
                'slug' => 'save-the-children’s-role-in-fight-against-malnutrition-hailed',
                'news_category_id' => NewsCategory::all()->random()->id,
                'description' => 'Your contribution has the power to uplift children in dire situations. We’re working towards a nation where its children live a secure life, full of opportunities for growth and development',
                'added_by' => '1',
            ]);
            DB::table('news_news_tags')->insert([
                'news_id' => $news1->id,
                'news_tags_id' => NewsTags::all()->random()->id,
            ]);

            $news2 = News::create([
                'title' => 'Back to the future: Quality education through',
                'slug' => 'back-to-the-future:-quality-education-through',
                'news_category_id' => NewsCategory::all()->random()->id,
                'description' => 'Donate For Education For One Poor Child For One Year and Help Them Secure Their Future Help A Poor Child In Completing is Education By donating In few Easy Steps',
                'added_by' => '1',
            ]);
            DB::table('news_news_tags')->insert([
                'news_id' => $news2->id,
                'news_tags_id' => NewsTags::all()->random()->id,
            ]);

            $news3 = News::create([
                'title' => 'Take Care Of The Elderly Without Home',
                'slug' => 'take-care-of-the-elderly-without-home',
                'news_category_id' => NewsCategory::all()->random()->id,
                'description' => 'Malnutrition is a condition that results from eating a diet lacking in nutrients and Malnutrition in children is especially harmful',
                'added_by' => $userId->id,
            ]);
            DB::table('news_news_tags')->insert([
                'news_id' => $news3->id,
                'news_tags_id' => NewsTags::all()->random()->id,
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
    }
}
