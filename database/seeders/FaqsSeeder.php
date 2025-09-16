<?php

namespace Database\Seeders;

use App\Models\Faqs;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FaqsSeeder extends Seeder
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
            $faqs = [
                [
                    'title' => 'How To Donate On Our Site Using Your Form?',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus dolor at libero ultricies ullamcorper vel ut dui. Maecenas sollicitudin risus non faucibus blandit. Nulla facilisi.',
                ],
                [
                    'title' => 'How To Became A Volunteer In Zambia State?',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus dolor at libero ultricies ullamcorper vel ut dui. Maecenas sollicitudin risus non faucibus blandit. Nulla facilisi.',
                ],
                [
                    'title' => 'How Can I Give My Clothes And Other Products?',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus dolor at libero ultricies ullamcorper vel ut dui. Maecenas sollicitudin risus non faucibus blandit. Nulla facilisi.',
                ],
                [
                    'title' => 'How To Donate On Our Site Using Your Form?',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus dolor at libero ultricies ullamcorper vel ut dui. Maecenas sollicitudin risus non faucibus blandit. Nulla facilisi..',
                ],
                [
                    'title' => 'How To Became A Volunteer In Zambia State?',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus dolor at libero ultricies ullamcorper vel ut dui. Maecenas sollicitudin risus non faucibus blandit. Nulla facilisi..',
                ],
                [
                    'title' => 'How Can I Give My Clothes And Other Products?',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus dolor at libero ultricies ullamcorper vel ut dui. Maecenas sollicitudin risus non faucibus blandit. Nulla facilisi.',
                ],
            ];

            foreach ($faqs as $faq) {
                Faqs::create($faq);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
    }
}
