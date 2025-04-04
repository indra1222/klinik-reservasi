<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeleteToTables extends Migration
{
    public function up()
    {
        Schema::table('dokter', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('pasien', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('reservasi', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('dokter', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('pasien', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('reservasi', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}