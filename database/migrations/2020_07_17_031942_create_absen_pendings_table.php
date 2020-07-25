<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsenPendingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absen_pending', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('semester_id');
            $table->string('time_in');
            $table->string('kelas_id');
            $table->string('keterangan');
            $table->string('note')->nullable();
            $table->boolean('konfirm');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absen_pending');
    }
}
