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
        Schema::create('check_payments', function (Blueprint $table) {
            $table->id('cp_id');
            $table->integer('user_id');
            $table->integer('amount');
            $table->string('name');
            $table->integer('account_number');
            $table->integer('pay_method');
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
        Schema::dropIfExists('check_payments');
    }
};
