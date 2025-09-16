<?php

namespace Database\Seeders;

use App\Models\CategoryThird;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ThirdCategorySeeder extends Seeder
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
            $category1 = CategoryThird::create([
                'title' => 'Pure Water',
            ]);

            $category2 = CategoryThird::create([
                'title' => 'Healthy Food',
            ]);

            $category3 = CategoryThird::create([
                'title' => 'No Poverty',
            ]);

            $category4 = CategoryThird::create([
                'title' => 'Good Health',
            ]);

            $category5 = CategoryThird::create([
                'title' => 'Partnerships',
            ]);
            $category6 = CategoryThird::create([
                'title' => 'Good Health',
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
    }
}
