<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class DefaultRoleSeeder extends Seeder
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
            $roles = [
                [
                    'name' => 'admin',
                    'display_name' => 'Admin',
                    'is_default' => true,
                ],
                [
                    'name' => 'user',
                    'display_name' => 'User',
                    'is_default' => true,
                ],
            ];
            foreach ($roles as $role) {
                Role::create($role);
            }

            /** @var Role $adminRole */
            $adminRole = Role::whereName('admin')->first();

            /** @var User $user */
            $user = User::whereEmail('admin@infyfund.com')->first();

            $allPermission = Permission::pluck('name', 'id');
            $adminRole->givePermissionTo($allPermission);
            if ($user) {
                $user->assignRole($adminRole);
            }

            /** @var Role $adminRole */
            $userRole = Role::whereName('user')->first();

            /** @var User $user */
            $user = User::whereEmail('user@infyfund.com')->first();

            $campaignPermission = ['manage_dashboard', 'manage_campaign'];
            $allPermission = Permission::whereName($campaignPermission)->get();
//        $allPermission = Permission::pluck('name', 'id');
            $adminRole->givePermissionTo($allPermission);
            if ($user) {
                $user->assignRole($userRole);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
    }
}
