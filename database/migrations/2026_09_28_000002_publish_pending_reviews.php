<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class PublishPendingReviews extends Migration
{
    /**
     * Publish legacy reviews that were waiting for the old manual approval flow.
     * Rejected reviews deliberately remain removed from public ratings.
     *
     * @return void
     */
    public function up()
    {
        DB::table('reviews')
            ->where('status', 'Pending')
            ->update(['status' => 'Approved', 'updated_at' => now()]);
    }

    /**
     * Do not restore Pending: reviews are now automatically published by design.
     *
     * @return void
     */
    public function down()
    {
        // Intentionally left blank.
    }
}
