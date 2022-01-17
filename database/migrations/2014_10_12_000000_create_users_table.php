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
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();

            /**
             * Display Name of User
             */
            $table->string('display_name');

            /**
             * Login Username of User
             */
            $table->string('username')->unique();

            /**
             * User email
             */
            $table->string('email')->unique();

            /**
             * Password
             */
            $table->string('password');
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
}
