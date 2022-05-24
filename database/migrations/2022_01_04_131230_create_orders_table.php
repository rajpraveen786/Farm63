<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('uid')->unsigned()->default(0);//User ID
            $table->integer('aid')->unsigned()->default(0);//Address ID
            $table->integer('pid')->unsigned()->default(0);//PromoCode ID
            $table->integer('pincodeid')->unsigned()->default(0);//PinCode ID
            $table->integer('storeid')->unsigned()->default(0);//PinCode ID

            $table->string('invno')->nullabe();//User ID
            $table->double('subcost',12,2)->default(0);//Sub Cost
            $table->double('discount',12,2)->default(0);//Discount Amount
            $table->double('shipping',12,2)->default(0);//Shipping Cost
            $table->double('taxtotal',12,2)->default(0);//Total
            $table->double('subtotal',12,2)->default(0);//Total
            $table->double('promocodeval',12,2)->default(0);//Tax Cost
            $table->double('total',12,2)->default(0);//Total
            $table->double('weight',12,2)->default(0);//Weight
            $table->json('address')->nullable();//Address
            // $table->boolean('pickfromstore')->default(0);//0 Pending
            $table->smallInteger('status')->default(0);
                                //0 Pending
                                //1 Approval
                                //2 Shipping
                                //3 Delivered
                                //4 Returned
                                //5 Not attend
                                //6 Canceled
                                //7 Canceled due to non payment
            $table->smallInteger('paytype')->default(0);
                                //0 Onine
                                //1 COD
            $table->smallInteger('paystatus')->default(0);
                                //0 Pending
                                //1 Paid
                                //2 Error
                                //3 Returned
            $table->longText('statusdet')->nullable();//Status Details
            $table->longText('paydet')->nullable();//Payment details
            $table->longText('invoice')->nullable();//Payment details
            $table->longText('remarks')->nullable();//Payment details
            $table->json('generaldata')->nullable();//JSON
            $table->dateTime('completed_at')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
