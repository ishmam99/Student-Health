<?php

use App\Models\User;
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
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('transaction_id')->unique();
            $table->double('amount');
            $table->string('method')->nullable();
            $table->tinyInteger('type')->comment('Check the transaction model constants for types.');
            $table->tinyInteger('status')->comment('Check the transaction model constants for status.');
            // $table->timestamp('created_at', 0)->default(DB::raw('CURRENT_TIMESTAMP'));
            // $table->timestamp('updated_at', 0)->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('transactions');
    }
}
