<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('loc')->nullable();
            $table->string('banner')->nullable();
            $table->longText('desc')->nullable();
            $table->boolean('homebanner')->default(0);
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
        Schema::dropIfExists('brands');
    }
}
