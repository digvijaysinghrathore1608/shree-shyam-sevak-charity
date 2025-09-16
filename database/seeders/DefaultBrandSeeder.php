<?php

namespace Database\Seeders;

use App\Models\Brand;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DefaultBrandSeeder extends Seeder
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
            $brand1 = Brand::create(['name' => 'HeartCare']);
            Brand::create(['name' => 'HeartCare']);
            $brand2 = Brand::create(['name' => 'Duragas']);
            $brand3 = Brand::create(['name' => 'SafeGuard']);
            $brand4 = Brand::create(['name' => 'Maxton Design ']);
            $brand5 = Brand::create(['name' => 'LogoType']);
            $brand5 = Brand::create(['name' => 'TurboLogo']);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
    }
}
