<?php

namespace App\Filament\Resources;

use App\Filament\Imports\PendudukImporter;
use App\Filament\Resources\PendudukResource\Pages;
use App\Models\Penduduk;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Facades\DB;

class PendudukResource extends Resource
{
    protected static ?string $model = Penduduk::class;
    protected static ?string $navigationLabel = 'Data Penduduk';
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Administrasi Desa';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('nkk')->required()->label('Nomor Kartu Keluarga'),
                TextInput::make('nik')->required()->unique()->label('Nomor Induk Kependudukan'),
                TextInput::make('nama')->required()->label('Nama Lengkap'),
                TextInput::make('tempat_lahir')->required()->label('Tempat Lahir'),
                DatePicker::make('tanggal_lahir')->required()->label('Tanggal Lahir'),
                TextInput::make('alamat')->required()->label('Alamat Lengkap'),
                Select::make('jenis_kelamin')
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ])
                    ->required()
                    ->label('Jenis Kelamin'),
                TextInput::make('rt')->required()->label('RT'),
                TextInput::make('rw')->required()->label('RW'),
                TextInput::make('pekerjaan')->nullable()->label('Pekerjaan'),
                FileUpload::make('kk')
                    ->label('Foto KK')
                    ->image()
                    ->directory('uploads/kk')
                    ->preserveFilenames()
                    ->maxSize(2048),
                FileUpload::make('ktp')
                    ->label('Foto KTP')
                    ->image()
                    ->directory('uploads/ktp')
                    ->preserveFilenames()
                    ->maxSize(2048),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('nkk')->sortable()->searchable()->label('NKK'),
                TextColumn::make('nik')->sortable()->searchable()->label('NIK'),
                TextColumn::make('nama')->sortable()->searchable()->label('Nama'),
                TextColumn::make('tempat_lahir')->sortable()->label('Tempat Lahir'),
                TextColumn::make('tanggal_lahir')->date()->sortable()->label('Tanggal Lahir'),
                TextColumn::make('alamat')->sortable()->searchable()->label('Alamat'),
                TextColumn::make('jenis_kelamin')->sortable()->label('Jenis Kelamin'),
                TextColumn::make('rt')->sortable()->label('RT'),
                TextColumn::make('rw')->sortable()->label('RW'),
                TextColumn::make('pekerjaan')->label('Pekerjaan'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\ImportAction::make()
                    ->importer(PendudukImporter::class),
                
                // ✅ Tambahkan tombol upload CSV
                // Action::make('importCsv')
                //     ->label('Upload CSV')
                //     ->icon('heroicon-o-arrow-up-tray')
                //     ->form([
                //         FileUpload::make('file')
                //             ->label('Pilih File CSV')
                //             ->required()
                //             ->acceptedFileTypes(['text/csv', 'text/plain']),
                //     ])
                //     ->action(function (array $data) {
                //         $path = storage_path('app/' . $data['file']);
                //         if (($handle = fopen($path, 'r')) !== false) {
                //             $isHeader = true;
                //             while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                //                 if ($isHeader) {
                //                     $isHeader = false;
                //                     continue;
                //                 }
                //                 // sesuaikan dengan kolom tabel
                //                 Penduduk::create([
                //                     'nkk' => $row[0] ?? null,
                //                     'nik' => $row[1] ?? null,
                //                     'nama' => $row[2] ?? null,
                //                     'tempat_lahir' => $row[3] ?? null,
                //                     'tanggal_lahir' => $row[4] ?? null,
                //                     'alamat' => $row[5] ?? null,
                //                     'jenis_kelamin' => $row[6] ?? null,
                //                     'rt' => $row[7] ?? null,
                //                     'rw' => $row[8] ?? null,
                //                     'pekerjaan' => $row[9] ?? null,
                //                 ]);
                //             }
                //             fclose($handle);
                //         }
                //     })
                //     ->color('success')
                //     ->modalHeading('Import Data Penduduk dari CSV')
                //     ->modalButton('Upload'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenduduks::route('/'),
            'create' => Pages\CreatePenduduk::route('/create'),
            'edit' => Pages\EditPenduduk::route('/{record}/edit'),
        ];
    }
}
