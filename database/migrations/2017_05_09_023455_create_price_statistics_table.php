<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_vendor_id')->unsigned();
            $table->double('harga');
            $table->timestamps();
            $table->foreign('product_vendor_id')->references('id')
                ->on('product_vendors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_statistics');
    }
}
