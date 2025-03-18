<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Surat;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Role::query()->firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        Role::query()->firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

        $adminUser = User::firstOrCreate([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $adminUser->assignRole('admin');

        Page::firstOrCreate(['name' => 'profile', 'content' => '']);
        Page::firstOrCreate(['name' => 'sejarah', 'content' => '']);

        $mapFn = fn($v, $k) => ['type' => 'form', 'data' => ['key' => $k, 'rules' => $v]];

        Surat::firstOrCreate([
            'name' => 'SKTM Rumah Sakit',
            'slug' => 'sktm',
            'input_format' => collect([
                "nik" => ['required'],
                "name" => ['required'],
                "tempat_lahir" => ['required'],
                "tanggal_lahir" => ['required', 'date'],
                "gender" => ['required', 'in:l,p'],
                "kewarganegaraan" => ['required'],
                "agama" => ['required'],
                "alamat" => ['required'],
            ])
            ->map($mapFn)
            ->toArray(),
            'value_format' => [
                'gender' => '${value:enum:l=Laki-laki|p=Perempuan}',
                'tanggal_lahir' => '${value:date:d-m-Y}',
            ],
        ]);

        Surat::firstOrCreate([
            'name' => 'SKTM Sekolah',
            'slug' => 'sktm2',
            'input_format' => collect([
                "no_kk" => ['required'],
                "nama_kk" => ['required'],
                "tempat_lahir_kk" => ['required'],
                "tanggal_lahir_kk" => ['required', 'date'],
                "gender_kk" => ['required', 'in:l,p'],
                "pekerjaan_kk" => ['required'],
                "nama_anak" => ['required'],
                "nik_anak" => ['required'],
                "tempat_lahir_anak" => ['required'],
                "tanggal_lahir_anak" => ['required', 'date'],
                "gender_anak" => ['required', 'in:l,p'],
                "nama_sekolah" => ['required'],
                "alamat" => ['required'],
            ])
            ->map($mapFn)
            ->toArray(),
            'value_format' => [
                'gender_kk' => '${value:enum:l=Laki-laki|p=Perempuan}',
                'gender_anak' => '${value:enum:l=Laki-laki|p=Perempuan}',
                'tanggal_lahir_kk' => '${value:date:d-m-Y}',
                'tanggal_lahir_anak' => '${value:date:d-m-Y}',
            ],
        ]);

        Surat::firstOrCreate([
            'name' => 'Surat  Beda Nama',
            'slug' => 'nama',
            'input_format' => collect([
                "nama_ktp" => ['required'],
                "tempat_lahir_ktp" => ['required'],
                "tanggal_lahir_ktp" => ['required', 'date'],
                "alamat_ktp" => ['required'],
                "nama_sertifikat" => ['required'],
                "tempat_lahir_sertifikat" => ['required'],
                "tanggal_lahir_sertifikat" => ['required', 'date'],
                "alamat_sertifikat" => ['required'],
            ])
            ->map($mapFn)
            ->toArray(),
            'value_format' => [
                'tanggal_lahir_ktp' => '${value:date:d-m-Y}',
                'tanggal_lahir_sertifikat' => '${value:date:d-m-Y}',
            ],
        ]);

        Surat::firstOrCreate([
            'name' => 'Surat Survey',
            'slug' => 'survey',
            'input_format' => collect([
                "no_kk" => ['required'],
                "nama_kk" => ['required'],
                "nik" => ['required'],
                "tempat_lahir" => ['required'],
                "tanggal_lahir" => ['required', 'date'],
                "pekerjaan" => ['required'],
                "nama_diajukan" => ['required'],
                "nik_diajukan" => ['required'],
                "alamat" => ['required'],
                "ketua_rt" => ['required'],
                "ketua_rw" => ['required'],
                "kader" => ['required'],
                "puskesos" => ['required'],
            ])
            ->map($mapFn)
            ->toArray(),
            'value_format' => [
                'tanggal_lahir' => '${value:date:d-m-Y}',
            ],
        ]);

        Surat::firstOrCreate([
            'name' => 'Surat Usaha',
            'slug' => 'usaha',
            'input_format' => collect([
                "nik" => ['required'],
                "name" => ['required'],
                "tempat_lahir" => ['required'],
                "tanggal_lahir" => ['required', 'date'],
                "gender" => ['required', 'in:l,p'],
                "kewarganegaraan" => ['required'],
                "agama" => ['required'],
                "pekerjaan" => ['required'],
                "jenis_usaha" => ['required'],
                "alamat" => ['required'],
            ])
            ->map($mapFn)
            ->toArray(),
            'value_format' => [
                'gender' => '${value:enum:l=Laki-laki|p=Perempuan}',
                'tanggal_lahir' => '${value:date:d-m-Y}',
            ],
        ]);
    }
}
