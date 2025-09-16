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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('description')->nullable();
            $table->date('event_date');
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->integer('available_tickets');
            $table->string('event_organizer_name')->nullable();
            $table->string('event_organizer_email')->nullable();
            $table->string('event_organizer_phone')->nullable();
            $table->string('event_organizer_website')->nullable();
            $table->string('venue')->nullable();
            $table->string('venue_location')->nullable();
            $table->string('venue_phone')->nullable();
            $table->boolean('status')->default(true)->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('event_categories')
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
        Schema::dropIfExists('events');
    }
};
