<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOTPSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('o_t_p_s', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('uid')->unsigned()->default(0);
            $table->smallInteger('type')->unsigned()->default(0);//email or phone numebr
            $table->string('value')->nullable();///phone number or email
            $table->string('reason')->nullable();///phone number or email
            $table->string('code')->nullable();
            $table->timestamp('expdate')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('o_t_p_s');
    }
}