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
            // Tambahkan kolom jika belum ada
            if (!Schema::hasColumn('bookings', 'vehicle_id')) {
                $table->unsignedBigInteger('vehicle_id')->nullable();
            }

            // Tambahkan foreign key
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop foreign key
            $table->dropForeign(['vehicle_id']);
            
            // Drop kolom jika ditambahkan di up()
            if (Schema::hasColumn('bookings', 'vehicle_id')) {
                $table->dropColumn('vehicle_id');
            }
        });
    }
};

