<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReviewFieldV2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function($table) {
            $table->integer('user_id')->unsigned()->after('id');
            $table->integer('product_vendor_id')->unsigned()->after('user_id');
            $table->float('rating')->after('product_vendor_id');
            $table->text('body')->nullable()->after('rating');
            $table->foreign('user_id')->references("id")->on('users')
                ->onDelete('cascade');
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
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['product_vendor_id']);
            $table->dropColumn(['user_id', 'product_vendor_id', 'rating', 'body']);
        });
    }
}
