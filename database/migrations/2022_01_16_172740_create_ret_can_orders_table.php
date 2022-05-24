<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetCanOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ret_can_orders', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('oid')->unsigned()->default(0);//ORder ID
            $table->smallInteger('type')->unsigned()->default(0);//0 cancel 1 return
            $table->smallInteger('status')->unsigned()->default(0);//0 pending 1 processed 2 failed
            $table->smallInteger('refundstatus')->unsigned()->default(0);//0 Null 1 partial 2 Full
            $table->smallInteger('paytype')->unsigned()->default(0);//0 Card 1 NetBanking 2 Wallet 3 EMI 4 UPI
            $table->longText('error')->nullable();
            $table->longText('orderid')->nullable();//ORder ID
            $table->longText('payrazorpaymentid')->nullable();//ORder ID
            $table->longText('refundrazorpaymentid')->nullable();//ORder ID
            $table->double('orderAmount',15,2)->default(0);
            $table->double('amount_refunded',15,2)->default(0);
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
        Schema::dropIfExists('ret_can_orders');
    }
}
