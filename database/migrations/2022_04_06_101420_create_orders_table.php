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
        Schema::create('orders', function (Blueprint $table) {
            $table->string('id', 36)->index()->unique();
            $table->string('user_id');
            $table->string('token', 100)->nullable();
            $table->smallInteger('status')->nullable();
            $table->float('subTotal')->nullable();
            $table->float('itemDiscount')->nullable();
            $table->float('tax')->nullable();
            $table->float('shipping')->nullable();
            $table->float('total')->nullable();
            $table->string('promo', 50)->nullable();
            $table->float('discount')->nullable();
            $table->float('grandTotal')->nullable();
            $table->string('firstName', 50)->nullable();
            $table->string('middleName', 50)->nullable();
            $table->string('lastName', 50)->nullable();
            $table->string('mobile', 15)->nullable();
            $table->string('email')->nullable();
            $table->string('line1', 50)->nullable();
            $table->string('line2', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('province', 50)->nullable();
            $table->string('country', 50)->nullable();
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
        Schema::dropIfExists('orders');
    }
};
