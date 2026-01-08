<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone')->unique();
            $table->string('password')->nullable();
            $table->string('role')->default('client'); // Default role is client
            $table->string('otp')->nullable();
            $table->string('otp_expiry')->nullable();
            $table->string('city')->nullable();
            $table->string('locality')->nullable();
            $table->string('avatar')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('speciality')->nullable();
            $table->string('experience')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('language')->nullable();
            $table->string('education')->nullable();
            $table->string('bio')->nullable();
            $table->string('certification_name')->nullable();
            $table->string('certified_by')->nullable();
            $table->date('completion_date')->nullable();
            $table->double('price')->nullable();
            $table->string('status')->default('Pending');
            $table->double('longitude')->nullable();
            $table->double('latitude')->nullable();
            $table->double('commission_rate')->default(0);
            $table->timestamps();



        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}