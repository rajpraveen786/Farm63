<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->longText('loc')->nullable();//1 value
            $table->unsignedsmallInteger('discounttype')->default(0);//0 percentage 1 fixed amount 
            $table->string('value')->nullable();//Amount


            $table->unsignedsmallInteger('appliesfor')->default(0);//0 all products 1 Category 2 prodcut
            $table->longText('appliesfordata')->nullable();//0 IDS of category/product

            $table->longText('optid')->nullable();//0 allp products 1 Category 2 prodcut
            
            $table->smallInteger('minreqtype')->default(0);//0 Minimum purchase amount 1 qty
            $table->longText('minreqvalue')->nullable();// Min Request Details
            $table->longText('minreqdata')->nullable();// Min Request Id

            $table->string('startdate')->nullable();//Start date
            $table->string('enddate')->nullable();//End start
            $table->boolean('status')->default(0);//staus
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
        Schema::dropIfExists('discounts');
    }
}
