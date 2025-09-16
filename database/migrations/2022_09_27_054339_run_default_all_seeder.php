<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Artisan::call('db:seed', ['--class' => 'DefaultUserSeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'SettingTableSeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'DefaultPermissionSeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'DefaultRoleSeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'CountryTableSeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'AboutUsTableSeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'AddSettingSeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'VideoSectionTableSeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'ContactUsTableSeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'DefaultSliderSeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'DefaultCampaignCategorySeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'DefaultCampaignSeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'DefaultNewsTagSeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'DefaultNewsCategorySeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'DefaultNewsSeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'DefaultBrandSeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'DefaultEventCategorySeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'DefaultEventSeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'DefaultTeamSeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'DefaultCategorySeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'FaqsSeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'SecondVideoSeederTable', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'SecondSliderSeederTable', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'ThirdVideoSectionSeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'ThirdCategorySeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'ThirdSliderSeederTable', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'SliderCardSeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'UpdateDefaultSlugSeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'LanguageTableSeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'DefaultPaymentStatusSeeder', '--force' => true]);
        Artisan::call('db:seed', ['--class' => 'DefaultWithdrawalSeeder', '--force' => true]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
