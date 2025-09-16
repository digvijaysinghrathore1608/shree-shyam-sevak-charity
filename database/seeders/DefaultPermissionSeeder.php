<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;

class DefaultPermissionSeeder extends Seeder
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
            $permissions = [
                [
                    'name' => 'manage_users',
                    'display_name' => 'Manage User',
                ],
                [
                    'name' => 'manage_settings',
                    'display_name' => 'Manage Settings',
                ],
                [
                    'name' => 'manage_roles',
                    'display_name' => 'Manage Roles',
                ],
                [
                    'name' => 'manage_dashboard',
                    'display_name' => 'Manage Dashboard',
                ],
                [
                    'name' => 'manage_countries',
                    'display_name' => 'Manage Countries',
                ],
                //            [
                //                'name'         => 'manage_sliders',
                //                'display_name' => 'Manage Sliders',
                //            ],
                [
                    'name' => 'manage_events',
                    'display_name' => 'Manage Events',
                ],
                [
                    'name' => 'manage_inquiries',
                    'display_name' => 'Manage Inquiries',
                ],
                [
                    'name' => 'manage_pages',
                    'display_name' => 'Manage Pages',
                ],
                [
                    'name' => 'manage_success_stories',
                    'display_name' => 'Manage Success Stories',
                ],
                [
                    'name' => 'manage_brands',
                    'display_name' => 'Manage Brands',
                ],
                //            [
                //                'name'         => 'manage_news_categories',
                //                'display_name' => 'Manage News Categories',
                //            ],
                //            [
                //                'name'         => 'manage_news_tags',
                //                'display_name' => 'Manage News Tags',
                //            ],
                [
                    'name' => 'manage_email_subscribe',
                    'display_name' => 'Manage Email Subscribe',
                ],
                [
                    'name' => 'manage_about_us',
                    'display_name' => 'Manage About Us',
                ],
                [
                    'name' => 'manage_news',
                    'display_name' => 'Manage News',
                ],
                [
                    'name' => 'manage_campaign',
                    'display_name' => 'Manage Campaign',
                ],
                //            [
                //                'name'         => 'manage_campaign_categories',
                //                'display_name' => 'Manage Campaign Categories',
                //            ],
                //            [
                //                'name'         => 'manage_video_section',
                //                'display_name' => 'Manage Video Section',
                //            ],
                //            [
                //                'name'         => 'manage_call_to_action',
                //                'display_name' => 'Manage Call To Action',
                //            ],
                [
                    'name' => 'manage_contact_us',
                    'display_name' => 'Manage Contact Us',
                ],
                [
                    'name' => 'manage_teams',
                    'display_name' => 'Manage Teams',
                ],
                [
                    'name' => 'manage_faqs',
                    'display_name' => 'Manage Faqs',
                ],
                //            [
                //                'name'         => 'manage_sliders2',
                //                'display_name' => 'Manage Slider 2',
                //            ],
                //            [
                //                'name'         => 'manage_categories',
                //                'display_name' => 'Manage Categories',
                //            ],
                //            [
                //                'name'         => 'manage_second_video_section',
                //                'display_name' => 'Manage Second Video Section ',
                //            ],
                [
                    'name' => 'manage_sliders_third',
                    'display_name' => 'Manage Sliders ',
                ],
                [
                    'name' => 'manage_categories_third',
                    'display_name' => 'Manage Categories',
                ],
                [
                    'name' => 'manage_video_section_third',
                    'display_name' => 'Manage Video Section ',
                ],
                [
                    'name' => 'manage_terms_conditions',
                    'display_name' => 'Manage Terms Conditions',
                ],
            ];
            foreach ($permissions as $permission) {
                Permission::create($permission);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
    }
}
