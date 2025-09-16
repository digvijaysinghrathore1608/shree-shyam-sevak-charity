<?php

namespace Database\Seeders;

use App\Models\NewsCategory;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DefaultNewsCategorySeeder extends Seeder
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
            $newsCategories = [
                [
                    'name' => 'Charity',
                ],
                [
                    'name' => 'Education',
                ],
                [
                    'name' => 'Food',
                ],
            ];

            foreach ($newsCategories as $newsCategory) {
                NewsCategory::create($newsCategory);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
    }
}
