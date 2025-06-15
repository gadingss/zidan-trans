<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePaymentStatusToVarcharOnPaymentsTable extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Ubah kolom payment_status dari enum ke varchar(50)
            $table->string('payment_status', 50)->change();
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Jika ingin rollback, ubah kembali jadi enum (sesuaikan enum aslinya)
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'cancel'])->change();
        });
    }
}
