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
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('nama');
            $table->integer('umur');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('pekerjaan'); 
            $table->string('status_kawin');
            $table->string('kewarganegaraan');
            $table->string('domisili');
            $table->string('status_hidup');
            $table->string('hak_pilih');

            // Kolom ini akan kosong di menu Data Penduduk,
            // tapi akan terisi setelah proses Klasifikasi.
            $table->enum('status', ['Layak', 'Tidak Layak'])->nullable();
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};
