<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('type')->default(0);

            $table->integer('bid')->unsinged()->default(0);//Brand ID
            $table->integer('cid')->unsinged()->default(0);//Category ID
            $table->integer('scid')->unsinged()->default(0);//Sub Category ID
            $table->integer('uomid')->unsinged()->default(0);//Unit Of Measure ID
            $table->integer('packingid')->unsinged()->default(0);//Packing ID

            $table->string('name')->nullable();
            $table->longText('urlslug')->nullable();
            $table->longText('shortdesc')->nullable();
            $table->longText('desc')->nullable();
            $table->longText('attribute')->nullable();
            $table->json('tags')->nullable();

            $table->longText('sku')->nullable();
            $table->longText('barcode')->nullable();
            $table->boolean('trackqty')->default(0);
            $table->boolean('oosc')->default(0);//Continue even if out of stock
            $table->boolean('da')->default(0);//Discount avilable

            $table->double('cpi',10,2)->default(0);//Cost per Item
            $table->double('fprice',10,2)->default(0);
            $table->double('margin',10,2)->default(0);//Cost per Item
            $table->double('profit',10,2)->default(0);//Cost per Item


            $table->integer('disid')->default(0);//Discount ID
            $table->double('disp')->default(0);
            $table->double('disa',10,2)->default(0);//Final price with TAX

            $table->double('taxp')->default(0);
            $table->double('taxa',10,2)->default(0);//Final price with TAX

            $table->double('actualprice',10,2)->default(0);// Actual price before Discount
            $table->double('fpricebefdis',10,2)->default(0);// Final price before Discount
            $table->double('fpricewtas',10,2)->default(0);//Final price with TAX

            $table->double('length',10,2)->default(0);//Length
            $table->double('width',10,2)->default(0);//Width
            $table->double('breadth',10,2)->default(0);//Breadth
            $table->integer('lunit')->unsinged()->default(0);//0 kg 1 g

            $table->double('weight',10,2)->default(0);//Final price with TAX
            $table->integer('wgunit')->unsinged()->default(0);//0 kg 1 g
            $table->bigInteger('stock')->default(0);
            $table->bigInteger('minstock')->default(0);

            $table->longText('seo_title')->nullable();
            $table->longText('seo_desc')->nullable();

            $table->integer('status')->default(0);//0-draft 1-Active
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
        Schema::dropIfExists('products');
    }
}
