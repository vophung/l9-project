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
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->string('id', 36)->index()->unique();
            $table->string('product_id');
            $table->string('parent_id')->nullable();
            $table->string('title', 100)->nullable();
            $table->smallInteger('rating')->nullable();
            $table->tinyInteger('published')->nullable();
            $table->timestamp('published_at')->useCurrent()->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('product_reviews');
    }
};
