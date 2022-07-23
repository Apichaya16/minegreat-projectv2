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
        Schema::create('purchase', function (Blueprint $table) {
            $table->id('pc_id');
            $table->integer('user_id');
            $table->integer('price');
            $table->string('product');
            $table->string('brand');
            $table->string('details');
            $table->integer('type');
            $table->integer('type_pay');
            $table->integer('discount');
            $table->integer('installment');
            $table->integer('balance_payment');
            $table->double('percen_current');
            $table->double('percen_consider');
            $table->integer('amount_consider');
            $table->integer('status');
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
        Schema::dropIfExists('purchase');
    }
};
