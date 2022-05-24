<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersSubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_subs', function (Blueprint $table) {
            $table->id();
            $table->integer('oid')->unsigned()->default(0);//User ID
            $table->integer('uid')->unsigned()->default(0);//User ID
            $table->integer('pid')->unsigned()->default(0);//Product ID
            $table->integer('catid')->unsigned()->default(0);//Category ID
            $table->integer('subcatid')->unsigned()->default(0);//Sub Category ID
            $table->integer('brandid')->unsigned()->default(0);//BRand ID
            $table->integer('disid')->unsigned()->default(0);//Discount ID
            $table->integer('disp')->unsigned()->default(0);//Discount ID
            $table->double('taxp',12,2)->default(0);//Tax Cost
            $table->double('disa',12,2)->default(0);//Tax Cost
            $table->double('taxa',12,2)->default(0);//Tax Cost

            $table->double('length',12,2)->default(0);//length
            $table->double('width',12,2)->default(0);//width
            $table->double('breadth',12,2)->default(0);//breadth
            $table->double('weight',12,2)->default(0);//Weight without qty

            $table->Text('name')->nullable();
            $table->double('singlecost',12,2)->default(0);//Sub Cost
            $table->double('subcost',12,2)->default(0);//value with discount
            $table->integer('qty')->unsigned()->default(0);//Discount ID
            $table->double('discount',12,2)->default(0);//Discount Amount
            $table->double('tax',12,2)->default(0);//Tax Cost
            $table->double('final',12,2)->default(0);//Cost
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
        Schema::dropIfExists('orders_subs');
    }
}
