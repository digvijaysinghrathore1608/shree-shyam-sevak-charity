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
        Schema::create('bank_account_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('withdrawal_request_id');
            $table->string('account_number');
            $table->string('isbn_number');
            $table->string('branch_name');
            $table->string('account_holder_name');
            $table->timestamps();

            $table->foreign('withdrawal_request_id')->references('id')->on('withdrawal_requests')
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
        Schema::dropIfExists('bank_account_details');
    }
};
