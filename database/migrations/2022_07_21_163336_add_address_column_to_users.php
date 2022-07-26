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
        Schema::table('users', function (Blueprint $table) {
            $table->smallInteger('is_admin')->default(0)->after('id');
            $table->string('surname')->nullable()->after('name');
            $table->string('street')->nullable();
            $table->string('phone')->nullable()->unique();
            $table->string('house_number')->nullable();
            $table->string('city')->nullable();
            $table->string('post_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['surname', 'street', 'phone', 'house_number', 'city', 'post_code']);
        });
    }
};
