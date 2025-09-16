<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();
            User::create([
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'contact' => '1234567890',
                'gender' => '1',
                'type' => '1',
                'email' => 'admin@infyfund.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('123456'),
                'is_default' => true,
            ]);

            User::create([
                'first_name' => 'John',
                'last_name' => 'Doe',
                'contact' => '1234567890',
                'gender' => '1',
                'type' => '1',
                'email' => 'user@infyfund.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('123456'),
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
    }
}
