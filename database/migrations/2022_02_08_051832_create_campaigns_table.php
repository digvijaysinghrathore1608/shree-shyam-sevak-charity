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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title', 191)->unique();
            $table->unsignedBigInteger('campaign_category_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('slug', 191)->unique();
            $table->text('short_description')->nullable();
            $table->text('description');
            $table->string('currency')->nullable();
            $table->double('goal')->nullable();
            $table->double('recommended_amount')->nullable();
            $table->string('amount_prefilled')->nullable();
            $table->integer('campaign_end_method')->nullable();
            $table->string('video_link')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('location')->nullable();
            $table->date('start_date')->nullable();
            $table->date('deadline')->nullable();
            $table->integer('status')->nullable();
            $table->boolean('is_featured')->nullable()->default(false);
            $table->boolean('is_emergency')->nullable()->default(false);
            $table->timestamps();

            $table->foreign('campaign_category_id')->references('id')->on('campaign_categories')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreign('country_id')->references('id')->on('countries')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
};
