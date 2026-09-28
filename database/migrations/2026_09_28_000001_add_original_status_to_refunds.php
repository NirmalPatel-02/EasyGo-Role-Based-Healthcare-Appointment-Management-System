<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOriginalStatusToRefunds extends Migration
{
    public function up()
    {
        Schema::table('refunds', function (Blueprint $table) {
            $table->string('original_appointment_status')->nullable()->after('reason');
        });
    }

    public function down()
    {
        Schema::table('refunds', function (Blueprint $table) {
            $table->dropColumn('original_appointment_status');
        });
    }
}
