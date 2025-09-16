<?php

namespace Database\Seeders;

use App\Models\FrontSliderThird;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ThirdSliderSeederTable extends Seeder
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
            $slider1 = FrontSliderThird::create([
                'title_1' => 'Healthy Foods',
                'title_2' => 'We are On A Mission To  Start Today',
            ]);

            $slider2 = FrontSliderThird::create([
                'title_1' => 'Our Mission:Medicine',
                'title_2' => 'More charity Make More better life',
            ]);

            $slider3 = FrontSliderThird::create([
                'title_1' => 'Our Mission:Education',
                'title_2' => 'We are On A Mission To Change That',
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
    }
}
