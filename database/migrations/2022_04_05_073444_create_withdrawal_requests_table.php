<?php

use App\Models\Withdraw;
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
        Schema::create('withdrawal_requests', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->float('amount')->nullable()->default(0);
            $table->boolean('is_approved')->nullable()->default(false);
            $table->integer('status')->nullable()->default(Withdraw::PENDING);
            $table->unsignedBigInteger('campaign_id');
            $table->string('admin_notes')->nullable();
            $table->string('user_notes')->nullable();
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
        Schema::dropIfExists('withdrawal_requests');
    }
};
