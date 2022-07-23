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
        Schema::create('status', function (Blueprint $table) {
            $table->id('s_id');
            $table->string('pass');
            $table->string('pending');
            $table->string('cancel');
            $table->string('stay');
            $table->string('check');
            $table->string('pickup');
            $table->string('overdue');
            $table->string('fullpayment');
            $table->string('other');
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
        Schema::dropIfExists('status');
    }
};
