<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('cid')->unsigned()->default(0);
            $table->string('name')->nullable();
            $table->string('loc')->nullable();
            $table->longText('desc')->nullable();
            $table->string('banner')->nullable();


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
        Schema::dropIfExists('sub_categories');
    }
}
