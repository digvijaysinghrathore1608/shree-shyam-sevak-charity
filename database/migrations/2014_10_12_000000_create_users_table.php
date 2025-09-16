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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email', 191)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('contact')->nullable();
            $table->integer('gender')->nullable();
            $table->date('dob')->nullable();
            $table->boolean('is_active')->default(1);
            $table->string('role')->nullable();
            $table->string('language')->default('en')->nullable();
            $table->text('address')->nullable();
            $table->string('country')->nullable();
            $table->integer('type')->nullable();
            $table->string('region_code')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
