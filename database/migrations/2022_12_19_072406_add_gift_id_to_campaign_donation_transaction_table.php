<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaign_donation_transaction', function (Blueprint $table) {
            $table->unsignedBigInteger('gift_id')->nullable();
            $table->foreign('gift_id')->references('id')->on('donation_gifts')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaign_donation_transaction', function (Blueprint $table) {
            $table->dropColumn('gift_id');
        });
    }
};
