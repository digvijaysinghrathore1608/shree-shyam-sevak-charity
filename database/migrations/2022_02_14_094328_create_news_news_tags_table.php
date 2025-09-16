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
        Schema::create('news_news_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_tags_id');
            $table->unsignedBigInteger('news_id');
            $table->timestamps();

            $table->foreign('news_tags_id')->references('id')->on('news_tags')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('news_id')->references('id')->on('news')
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
        Schema::dropIfExists('news_news_tags');
    }
};
