<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('id', 36)->index()->unique();
            $table->string('user_id');
            $table->string('title', 75)->nullable();
            $table->string('metaTitle', 100)->nullable();
            $table->string('slug', 100)->nullable();
            $table->mediumText('sumary')->nullable();
            $table->smallInteger('type')->nullable();
            $table->string('sku', 100)->nullable();
            $table->bigInteger('price')->nullable();
            $table->float('discount')->nullable();
            $table->smallInteger('quantity')->nullable();
            $table->tinyInteger('shop')->nullable();
            $table->timestamp('published_at')->useCurrent()->nullable();
            $table->timestamp('started_at')->useCurrent()->nullable();
            $table->timestamp('ended_at')->useCurrent()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
};
