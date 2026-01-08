<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('doctor_id');
            $table->string('time_slot');
            $table->date('dated');
            $table->string('status')->default('Pending');
            $table->string('rescheduled')->default('');
            $table->string('order_id')->default('');
            $table->string('payment_id')->default('');
            $table->double('doctor_price');
            $table->double('commission_rate');
            $table->double('gst_percent');
            $table->double('gst_amount');
            $table->double('platform_fee');
            $table->double('total_amount');
            $table->string('first_name')->default('');
            $table->string('last_name')->default('');
            $table->string('phone');
            $table->date('dob');
            $table->string('gender');
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('appointments');
    }
}