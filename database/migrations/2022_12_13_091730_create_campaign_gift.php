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
        Schema::create('campaign_gift', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campaign_id')->nullable();
            $table->unsignedBigInteger('donation_gift_id')->nullable();
            $table->timestamps();

            $table->foreign('campaign_id')->references('id')->on('campaigns')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('donation_gift_id')->references('id')->on('donation_gifts')
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
        Schema::dropIfExists('campaign_gift');
    }
};
