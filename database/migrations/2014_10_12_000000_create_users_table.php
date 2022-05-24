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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phno')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('type')->default(0);// 0 customer 1 admin 2 superadmin 3 Employee
            $table->integer('status')->default(1);// 0 Blocked 1 allowed
            $table->boolean('subscribe')->default(1);// Subscribe NewsLetter 0 not allowed 1 accepted
            $table->string('password');

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
}
