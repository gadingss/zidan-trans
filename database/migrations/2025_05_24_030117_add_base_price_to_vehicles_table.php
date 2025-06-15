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
        Schema::table('vehicles', function (Blueprint $table) {
            $table->integer('base_price')->after('status')->default(0); // Tambahkan kolom base_price
        });
    }
    
    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn('base_price');
        });
    }
    
};
