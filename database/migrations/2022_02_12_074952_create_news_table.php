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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->unsignedBigInteger('news_category_id');
            $table->longtext('description')->nullable();
            $table->unsignedBigInteger('added_by');
            $table->timestamps();

            $table->foreign('news_category_id')->references('id')->on('news_categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('added_by')->references('id')->on('users')
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
        Schema::drop('news');
    }
};
