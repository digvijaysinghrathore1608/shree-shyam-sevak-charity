<?php

namespace Database\Seeders;

use App\Models\Team;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DefaultTeamSeeder extends Seeder
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
            $team1 = Team::create([
                'name' => 'Mr. Salman Ahmad',
                'designation' => 'Founder',
            ]);

            $team2 = Team::create([
                'name' => 'Mrs. Dimassi Shatt',
                'designation' => 'CEO',
            ]);

            $team3 = Team::create([
                'name' => 'Mr. Paul Smith',
                'designation' => 'Support Staff',
            ]);

            $team4 = Team::create([
                'name' => 'Mr. John Thompson',
                'designation' => 'Support Staff',
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
    }
}
