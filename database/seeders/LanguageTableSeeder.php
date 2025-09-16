<?php

namespace Database\Seeders;

use App\Models\Language;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Class LanguageTableSeeder
 */
class LanguageTableSeeder extends Seeder
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
            Permission::create([
                'name' => 'manage_language',
                'display_name' => 'Manage Language',
            ]);
            /** @var Role $adminRole */
            $adminRole = Role::whereName('admin')->first();
            $permission = Permission::where('name', 'manage_language')->pluck('name', 'id');
            $adminRole->givePermissionTo($permission);
            Language::create([
                'name' => 'English',
                'iso_code' => 'en',
                'is_default' => true,
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
    }
}
