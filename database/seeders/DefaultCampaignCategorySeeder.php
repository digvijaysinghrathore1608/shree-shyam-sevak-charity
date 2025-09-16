<?php

namespace Database\Seeders;

use App\Models\CampaignCategory;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DefaultCampaignCategorySeeder extends Seeder
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
            $campaignCategories = [
                [
                    'name' => 'Food',
                ],
                [
                    'name' => 'Health',
                ],
                [
                    'name' => 'Water',
                ],
            ];

            foreach ($campaignCategories as $campaignCategory) {
                CampaignCategory::create($campaignCategory);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
    }
}
