<?php

namespace Database\Seeders;

use App\Models\NewsTags;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DefaultNewsTagSeeder extends Seeder
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
            $newsTags = [
                [
                    'name' => 'donate',
                ],
                [
                    'name' => 'help',
                ],
                [
                    'name' => 'water',
                ],
            ];

            foreach ($newsTags as $newsTag) {
                NewsTags::create($newsTag);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
    }
}
