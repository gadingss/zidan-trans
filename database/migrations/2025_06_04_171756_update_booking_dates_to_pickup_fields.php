<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'start_date')) {
                $table->dropColumn('start_date');
            }
    
            if (Schema::hasColumn('bookings', 'end_date')) {
                $table->dropColumn('end_date');
            }
    
            $table->date('pickup_date')->nullable()->after('booking_date');
            $table->time('pickup_time')->nullable()->after('pickup_date');
        });
    }
    
    
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (Schema::hasColumn('bookings', 'pickup_date')) {
                $table->dropColumn('pickup_date');
            }
    
            if (Schema::hasColumn('bookings', 'pickup_time')) {
                $table->dropColumn('pickup_time');
            }
    
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
        });
    }
    
    
};
