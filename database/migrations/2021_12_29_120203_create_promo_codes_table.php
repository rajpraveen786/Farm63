<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->longText('loc')->nullable();//1 value
            $table->longText('code')->nullable();//1 value
            $table->smallInteger('type');//0 percentage 1 fixed amount 2 buy x get y
            $table->string('value')->nullable();//Amount
            $table->smallInteger('subtype');//0 allp products 1 fCategory 2 prodcut
            $table->longText('optid')->nullable();//0 allp products 1 fCategory 2 prodcut
            $table->longText('subdata')->nullable();//Data desctription with
            $table->smallInteger('minreq')->default(0);//0 Minimum purchase amount 1 qty
            $table->longText('minreqdet')->nullable();// Min Request Details
            $table->longText('minreqdata')->nullable();// Min Request Id
            $table->string('startdate')->nullable();//Start date
            $table->string('enddate')->nullable();//End start

            //Usage Limits
            $table->boolean('oneuse')->default(0);//One User Per customer
            $table->integer('noofuse')->unisgned()->default(0);//Usage Per customer


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
        Schema::dropIfExists('promo_codes');
    }
}
