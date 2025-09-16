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
        Schema::create('campaign_donation_transaction', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->nullable();
            $table->integer('payment_method');
            $table->unsignedBigInteger('campaign_id');
            $table->float('amount')->nullable()->default(0);
            $table->longText('payload');
            $table->timestamps();

            $table->foreign('campaign_id')->references('id')->on('campaigns')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_donation_transaction');
    }
};
