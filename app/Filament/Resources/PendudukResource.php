<?php

namespace App\Filament\Resources;

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
                DeleteBulkAction::make()
                    ->label('Hapus Terpilih')
                    ->icon('heroicon-o-trash')
                    ->deselectRecordsAfterCompletion()
                    ->requiresConfirmation()
                    ->successNotificationTitle('Data penduduk berhasil dihapus'),
            ])
            ->actions([
                DeleteAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ])
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
