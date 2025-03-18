<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    public function run()
    {
        Page::create([
            'title' => 'Sejarah Desa',
            'slug' => 'sejarah-desa',
            'content' => '<p>Ini adalah konten sejarah desa.</p>',
        ]);
    }
}
