<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->string('mobile', 255)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255);
            $table->string('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->bigInteger('current_team_id')->nullable();
            $table->timestamp('deleted_at', 0)->nullable();
            $table->timestamp('last_password_change', 0)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('loggedtime_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->timestamp('last_active', 0);
            $table->tinyInteger('status');
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
        Schema::dropIfExists('loggedtime_users');
    }
}
