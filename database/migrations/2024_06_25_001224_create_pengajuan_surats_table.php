<?php

use App\Models\Surat;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengajuan_surats', function (Blueprint $table) {
            $table->id();
            $table->string('nomor')->nullable()->unique();
            $table->foreignIdFor(Surat::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->json('data');
            $table->enum('status', ['requested', 'accepted', 'rejected'])->default('requested');
            $table->date('tanggal_pengajuan')->nullable(); // Ubah dari timestamp ke date
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_surats');
    }
};
