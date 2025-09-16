<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventCategory;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DefaultEventSeeder extends Seeder
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

            $eventCategory = EventCategory::where('name', 'Festival')->first();
            $event1 = Event::create([
                'title' => 'Top 24 National Festivals of India that Reflect the Country’s Cultural Abundance',
                'slug' => 'top-24-national-festivals-of-india-that-reflect-the-country’s-cultural-abundance',
                'category_id' => $eventCategory->id,
                'description' => 'They say we should celebrate life, not just festivals. Well, in a country like India, life is synonymous with festivals because there are more fiestas than you can count, and each of these mirrors our culture and traditions. Breaking the humdrum of daily routine, these festivals bring with them a wave of excitement and happiness. Interestingly, almost every big and small occasion in India calls for a celebration. Be it the arrival of spring, harvesting of crops or something else, you will never run of out reasons and seasons to celebrate. Experiencing the festive spirit of the country is akin to celebrating life, speckled with an ample dose of colors, music, dance, folk songs, food, and friends, all rolled into a wholesome package offering absolute gratification..',
                'event_date' => Carbon::now()->add(10, 'day'),
                'start_time' => Carbon::now(),
                'end_time' => Carbon::now()->add(2, 'hour'),
                'available_tickets' => rand(1, 50),
                'event_organizer_name' => 'Miranda H',
                'event_organizer_email' => 'info@webmail.com',
                'event_organizer_phone' => '98709809809',
                'event_organizer_website' => 'event_organizer_website.com',
                'venue' => 'London',
                'venue_location' => '12/A, Miranda Halim City Town Hall, London',
                'venue_phone' => '9991113339',
            ]);
            $eventCategory = EventCategory::where('name', 'Pro Event')->first();
            $event2 = Event::create([
                'title' => 'Slate & Crystal Events',
                'slug' => 'slate-&-crystal-events',
                'category_id' => $eventCategory->id,
                'description' => 'You’ve decided to launch an event planning company. Congratulations! This is an exciting time filled with anticipation, nerves, and a to-do list a million miles long — including choosing a name for your business.

The name you pick for your event planning company can make or break your brand. It’s your calling card — so make sure it says what you want it to say. A great event company name captures attention, establishes the vibe of your business, and clarifies what your event design service is all about. That’s heavy lifting for a handful of words.',
                'event_date' => Carbon::now()->add(10, 'day'),
                'start_time' => Carbon::now(),
                'end_time' => Carbon::now()->add(2, 'hour'),
                'available_tickets' => rand(1, 50),
                'event_organizer_name' => 'Miranda H',
                'event_organizer_email' => 'info@webmail.com',
                'event_organizer_phone' => '98709809809',
                'event_organizer_website' => 'event_organizer_website.com',
                'venue' => 'London',
                'venue_location' => '12/A, Miranda Halim City Town Hall, London',
                'venue_phone' => '9991113339',
            ]);

            $eventCategory = EventCategory::where('name', 'Water Day')->first();
            $event3 = Event::create([
                'title' => 'Water and Climate Change',
                'slug' => 'water-and-climate-Change',
                'category_id' => $eventCategory->id,
                'description' => 'According to the UN organisation, "World Water Day 2022 is about water and climate change - and how the two are inextricably linked. The campaign shows how our use of water will help reduce floods, droughts, scarcity and pollution, and will help fight climate change itself.

By adapting to the water effects of climate change, we will protect health and save lives. And, by using water more efficiently, we will reduce greenhouse gases."

According to the UN organization, the key messages for World Water Day 2020 are as follows:

"We cannot afford to wait. Climate policymakers must put water at the heart of action plans."
"Water can help fight climate change. There are sustainable, affordable and scalable water and sanitation solutions."
"Everyone has a role to play. In our daily lives, there are surprisingly easy steps we can all take to address climate change."
On the significant event of World Water Day 2020, here are some of the inspirational, wise and thoughtful water slogans, sayings and quotes, have a look.',
                'event_date' => Carbon::now()->add(10, 'day'),
                'start_time' => Carbon::now(),
                'end_time' => Carbon::now()->add(2, 'hour'),
                'available_tickets' => rand(1, 50),
                'event_organizer_name' => 'Miranda H',
                'event_organizer_email' => 'info@webmail.com',
                'event_organizer_phone' => '98709809809',
                'event_organizer_website' => 'event_organizer_website.com',
                'venue' => 'London',
                'venue_location' => '12/A, Miranda Halim City Town Hall, London',
                'venue_phone' => '9991113339',
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
    }
}
