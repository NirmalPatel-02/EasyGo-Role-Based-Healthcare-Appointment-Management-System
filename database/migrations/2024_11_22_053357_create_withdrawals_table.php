<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id'); // References User.id
            $table->decimal('amount', 10, 2); 
            $table->string('status', 50); 
            $table->text('remarks')->nullable();
            $table->string('bank_name', 100); 
            $table->string('account_no', 50); 
            $table->string('ifsc', 50); 
            $table->string('branch_name', 150); 
            $table->string('holder_name', 50); 
            $table->string('transaction_id', 191); 
            $table->timestamps();
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdrawals');
    }
}
