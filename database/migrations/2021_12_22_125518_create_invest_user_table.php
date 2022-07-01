<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invest_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('invest_id')->constrained()->cascadeOnDelete();
            $table->tinyInteger('is_approved')->default(0);
            $table->tinyInteger('withdraw_status')->nullable();
            $table->string('prove_document');
            $table->double('profit_amount')->default(0);
            $table->double('invest_amount')->default(0);
            $table->timestamp('approved_at')->nullable();
            $table->string('transaction_id');
            $table->string('binance_id')->nullable();
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
        Schema::dropIfExists('invest_user');
    }
}
