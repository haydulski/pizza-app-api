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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('is_custom')->default(0);
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('pizza_id')->constrained('pizzas');
            $table->smallInteger('amount');
            $table->float('price', 4, 2);
            $table->enum('dough_size', ['30', '38']);
            $table->enum('double_cheese', ['no', 'yes']);
            $table->string('dough', 100)->nullable();
            $table->string('ingredient_1')->nullable();
            $table->string('ingredient_2')->nullable();
            $table->string('ingredient_3')->nullable();
            $table->string('ingredient_4')->nullable();
            $table->string('ingredient_5')->nullable();
            $table->string('ingredient_6')->nullable();
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
        Schema::dropIfExists('order_items');
    }
};
