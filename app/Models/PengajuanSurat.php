<?php

namespace App\Models;

use App\StatusPengajuanSurat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PengajuanSurat extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $casts = [
        'data' => 'json',
        'status' => StatusPengajuanSurat::class,
        'verified_at' => 'datetime',
        'tanggal_pengajuan' => 'date', // Menggunakan 'date' bukan 'datetime'
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function signSurats()
    {
        return $this->hasMany(SignSurat::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cached_berkas')->useDisk('public')->singleFile();
    }
}
