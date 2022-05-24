<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoggersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void`
     */
    public function up()
    {
        Schema::create('loggers', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('modid')->default(0);//Model Id
            $table->unsignedSmallInteger('uid')->default(0);
            $table->unsignedSmallInteger('type')->default(0);//0 add 1 edit 2 delete
            $table->text('page')->nullable();
            $table->json('newdata')->nullable();
            $table->json('olddata')->nullable();
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
        Schema::dropIfExists('loggers');
    }
}
