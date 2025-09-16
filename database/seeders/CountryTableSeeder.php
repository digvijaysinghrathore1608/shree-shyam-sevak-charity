<?php

namespace Database\Seeders;

use App\Models\Country;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CountryTableSeeder extends Seeder
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
            $countries = [
                [
                    'country_name' => 'India',

                ],
                [
                    'country_name' => 'Japan',
                ],
            ];
            foreach ($countries as $counrty) {
                Country::create($counrty);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
    }
}
