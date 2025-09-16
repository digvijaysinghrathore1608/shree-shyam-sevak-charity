<?php

namespace Database\Seeders;

use App\Models\Withdrawal;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DefaultWithdrawalSeeder extends Seeder
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
            $withdrawals = [
                [
                    'payment_type' => 'PayPal',
                    'discount_type' => '1',
                    'discount' => '10',
                ],
                [
                    'payment_type' => 'Bank',
                    'discount_type' => '1',
                    'discount' => '10',
                ],
            ];
            foreach ($withdrawals as $withdrawal) {
                Withdrawal::create($withdrawal);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }
    }
}
