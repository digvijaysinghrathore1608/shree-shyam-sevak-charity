<?php

namespace Database\Seeders;

use App\Models\EventCategory;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DefaultEventCategorySeeder extends Seeder
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
            EventCategory::create(['name' => 'Water Day']);
            EventCategory::create(['name' => 'Festival']);
            EventCategory::create(['name' => 'Pro Event']);
            EventCategory::create(['name' => 'Trending']);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
    }
}
