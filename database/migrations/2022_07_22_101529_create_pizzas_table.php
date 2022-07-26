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
        Schema::create('pizzas', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('slug');
            $table->float('price');
            $table->string('img');
            $table->string('thumbnail');
            $table->string('dough', 100);
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
        Schema::dropIfExists('pizzas');
    }
};
