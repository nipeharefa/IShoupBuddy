<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transaction_id')->unsigned();
            $table->integer('product_vendor_id')->unsigned();
            $table->integer('quantity')->default(1);
            $table->double('harga')->default(1);
            $table->double('total')->virtualAs('quantity * harga');
            $table->timestamps();
            $table->foreign('transaction_id')->references('id')->on('transactions')
                ->onDelete('cascade');
            $table->foreign('product_vendor_id')->references('id')->on('product_vendors')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_details');
    }
}
