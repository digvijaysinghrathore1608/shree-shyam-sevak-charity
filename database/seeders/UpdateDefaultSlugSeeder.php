<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Event;
use App\Models\News;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateDefaultSlugSeeder extends Seeder
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
            Campaign::where('title', 'Emergency Response And School Food')->update([
                'slug' => 'emergency-respo',
            ]);
            Campaign::where('title', 'People Health Response And Village Mans')->update([
                'slug' => 'people-health-r',
            ]);
            Campaign::where('title', 'Because Everyone Deserves Clean Water')->update([
                'slug' => 'because-everyon',
            ]);

            Event::where('title',
                'Top 24 National Festivals of India that Reflect the Country’s Cultural Abundance')->update([
                    'slug' => 'top-24-nationa',
                    'title' => 'Top 24 National Festivals',
                    'event_organizer_website' => 'www.meta.com',
                ]);
            Event::where('title', 'Slate & Crystal Events')->update([
                'slug' => 'slate-&-crystal',
                'event_organizer_website' => 'www.meta.com',
            ]);
            Event::where('title', 'Water and Climate Change')->update([
                'slug' => 'water-and-clima',
                'event_organizer_website' => 'www.meta.com',
            ]);

            News::where('title', 'Save the Children Role in Fight Against Malnutrition Hailed')->update([
                'slug' => 'save-the-childr',
            ]);
            News::where('title', 'Back to the future: Quality education through')->update([
                'slug' => 'back-to-the-fut',
            ]);
            News::where('title', 'Take Care Of The Elderly Without Home')->update([
                'slug' => 'take-care-of-th',
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
    }
}
