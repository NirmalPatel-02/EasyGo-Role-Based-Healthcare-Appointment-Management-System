<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRefundWorkflowColumns extends Migration
{
    public function up()
    {
        Schema::table('refunds', function (Blueprint $table) {
            $table->string('status')->default('Pending')->after('amount');
            $table->text('reason')->nullable()->after('status');
            $table->string('refund_id')->nullable()->unique()->after('reason');
            $table->unsignedBigInteger('processed_by')->nullable()->after('refund_id');
            $table->timestamp('processed_at')->nullable()->after('processed_by');
            $table->text('failure_reason')->nullable()->after('processed_at');
            $table->index(['appointment_id', 'status']);
        });
    }

    public function down()
    {
        Schema::table('refunds', function (Blueprint $table) {
            $table->dropIndex(['appointment_id', 'status']);
            $table->dropUnique(['refund_id']);
            $table->dropColumn(['status', 'reason', 'refund_id', 'processed_by', 'processed_at', 'failure_reason']);
        });
    }
}
