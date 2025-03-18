<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Surat extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $casts = [
        'input_format' => 'json',
        'value_format' => 'json',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function verified_by()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function pengajuans()
    {
        return $this->hasMany(PengajuanSurat::class);
    
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('surat')
            ->singleFile();
    }
}
