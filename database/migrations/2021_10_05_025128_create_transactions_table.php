<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payer');
            $table->unsignedBigInteger('payee')->nullable();
            $table->integer('operation_type');
            $table->integer('status')->default(0);
            $table->float('value', 15, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('payer')->references('id')->on('users');
            $table->foreign('payee')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
