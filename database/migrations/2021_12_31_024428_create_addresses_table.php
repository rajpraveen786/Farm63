->nullable()<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('uid')->unsigned()->default(0);
            $table->integer('pid')->unsigned()->default(0);
            $table->string('name')->nullable();///
            $table->string('phno')->nullable();///
            $table->string('pincode')->nullable();///
            $table->string('houseno')->nullable();//Flat, House no., Building, Company, Apartment
            $table->string('area')->nullable();//Area, Street, Sector, Village
            $table->string('landmark')->nullable();//Landmark
            $table->string('city')->nullable();//Town/City
            $table->string('state')->nullable();//State
            $table->string('country')->nullable();//State
            $table->boolean('default')->default(0);//Flat, House no., Building, Company, Apartment
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
        Schema::dropIfExists('addresses');
    }
}
