<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Produk extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['nama_produk', 'harga_produk', 'deskripsi_produk', 'gambar_produk'];

}
