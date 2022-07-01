<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('cost');
            $table->integer('minimum_withdraw_amount')->default(0);
            $table->boolean('status')->default(1);
            $table->integer('tasks');
            $table->double('ads_period_1_price');
            $table->double('ads_period_2_price');
            $table->double('ads_period_3_price');
            $table->double('ads_period_4_price');
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
        Schema::dropIfExists('packages');
    }
}
