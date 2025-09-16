<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\CampaignCategory;
use App\Models\Country;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DefaultCampaignSeeder extends Seeder
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
            $campaign1 = Campaign::create([
                'title' => 'Emergency Response And School Food',
                'slug' => 'emergency_response_and_school_food',
                'campaign_category_id' => CampaignCategory::all()->random()->id,
                'user_id' => User::all()->random()->id,
                'country_id' => Country::all()->random()->id,
                'status' => Campaign::STATUS_ACTIVE,
                'short_description' => 'Nutritious school food helps students develop lifelong healthy eating habits',
                'description' => 'This campaign helps students develop lifelong healthy eating habits',
                'currency' => 'inr',
                'goal' => '1000',
                'recommended_amount' => '2000',
                'amount_prefilled' => '500',
                'campaign_end_method' => Campaign::AFTER_END_DATE,
                'video_link' => 'https://www.youtube.com/watch?v=QvkDDA62-tw&ab_channel=ComplexRealities',
                'location' => 'uganda',
                'start_date' => Carbon::now(),
                'deadline' => Carbon::now()->addMonth(),
                'is_featured' => '1',
                'is_emergency' => '1',
            ]);

            $campaign2 = Campaign::create([
                'title' => 'People Health Response And Village Mans',
                'slug' => 'people_health_response_and_village_mans',
                'campaign_category_id' => CampaignCategory::all()->random()->id,
                'user_id' => User::all()->random()->id,
                'country_id' => Country::all()->random()->id,
                'status' => Campaign::STATUS_ACTIVE,
                'short_description' => 'Nutritious school food helps students develop lifelong healthy eating habits',
                'description' => 'This campaign helps students develop lifelong healthy eating habits',
                'currency' => 'inr',
                'goal' => '3000',
                'recommended_amount' => '5000',
                'amount_prefilled' => '2000',
                'campaign_end_method' => Campaign::AFTER_END_DATE,
                'video_link' => 'https://www.youtube.com/watch?v=QvkDDA62-tw&ab_channel=ComplexRealities',
                'location' => 'uganda',
                'start_date' => Carbon::now(),
                'deadline' => Carbon::now()->addMonth(),
                'is_featured' => '1',
                'is_emergency' => '1',
            ]);

            $campaign3 = Campaign::create([
                'title' => 'Because Everyone Deserves Clean Water',
                'slug' => 'because_everyone_deserves_clean_water',
                'campaign_category_id' => CampaignCategory::all()->random()->id,
                'user_id' => User::all()->random()->id,
                'country_id' => Country::all()->random()->id,
                'status' => Campaign::STATUS_ACTIVE,
                'short_description' => 'Nutritious school food helps students develop lifelong healthy eating habits',
                'description' => 'This campaign helps students develop lifelong healthy eating habits',
                'currency' => 'inr',
                'goal' => '5000',
                'recommended_amount' => '7000',
                'amount_prefilled' => '1000',
                'campaign_end_method' => Campaign::AFTER_END_DATE,
                'video_link' => 'https://www.youtube.com/watch?v=QvkDDA62-tw&ab_channel=ComplexRealities',
                'location' => 'uganda',
                'start_date' => Carbon::now(),
                'deadline' => Carbon::now()->addMonth(),
                'is_featured' => '1',
                'is_emergency' => '1',
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
    }
}
