<?php

use App\Models\PengajuanSurat;
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
        Schema::create('sign_surats', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PengajuanSurat::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string("signature_code");
            $table->string("original_filename")->nullable();
            $table->string("original_filepath")->nullable();
            $table->string("signatured_filepath")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sign_surats');
    }
};
