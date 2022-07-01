<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->nullable()->constrained('packages')->nullOnDelete();
            // $table->foreignId('club_id')->nullable()->constrained('clubs')->nullOnDelete();
            // $table->foreignId('rank_id')->nullable()->constrained('ranks')->nullOnDelete();
            $table->foreignId('referred_by')->nullable()->constrained('users')->nullOnDelete();
            $table->decimal('balance')->default(0);
            $table->decimal('referral_balance')->default(0);
            // $table->decimal('s_coin')->default(0);
            $table->string('name');
            $table->string('uid')->unique();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('country')->nullable();
            $table->string('password');
            $table->boolean('status')->default(1);
            $table->boolean('is_admin')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('account_expire_on')->nullable();
            $table->unsignedBigInteger('count_referred_user')->default(0);
            $table->string('binance_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
