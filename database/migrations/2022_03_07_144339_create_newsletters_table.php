<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewslettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletters', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('subject')->nullable();
            $table->unsignedInteger('template')->default(0)->nullable();
            $table->json('type');//loc
            $table->longText('members')->nullable();
            $table->longText('content')->nullable();
            $table->string('datetime')->nullable();
            $table->smallInteger('status')->default(0);
            $table->smallInteger('sent')->default(0);
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
        Schema::dropIfExists('newsletters');
    }
}
