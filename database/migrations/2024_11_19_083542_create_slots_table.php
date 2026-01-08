<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('slots', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('doctor_id'); // Refers to User ID
        $table->string('time_slot'); // Stores slot time
        $table->timestamps();

        // Add foreign key constraint
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
        Schema::dropIfExists('slots');
    }
}
