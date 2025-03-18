<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Jalankan migration.
     */
    public function up()
{
    Schema::create('penduduks', function (Blueprint $table) {
        $table->id();
        $table->string('nkk', 16);
        $table->string('nik', 16)->unique();
        $table->string('nama');
        $table->string('tempat_lahir');
        $table->date('tanggal_lahir');
        $table->text('alamat');
        $table->string('jenis_kelamin', 15); // Pastikan jenis_kelamin bisa menampung nilai 'Laki-laki' atau 'Perempuan'
        $table->string('rt', 3);
        $table->string('rw', 3);
        $table->string('pekerjaan')->nullable();
        $table->timestamps();
    });
    
}

    /**
     * Hapus tabel jika di-rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};
