<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengajuanSuratResource\Pages;
use App\Filament\Resources\PengajuanSuratResource\RelationManagers;
use App\Filament\Resources\PengajuanSuratResource\RelationManagers\SignSuratsRelationManager;
use App\Models\PengajuanSurat;
use App\Models\Surat;
use App\StatusPengajuanSurat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengajuanSuratResource extends Resource
{
    protected static ?string $navigationLabel = 'Kelola Pengajuan Surat';
    protected static ?string $label = 'Pengajuan Surat';
    protected static ?string $model = PengajuanSurat::class;
    protected static ?string $modelLabel = 'Pengajuan Surat';
    protected static ?string $navigationGroup = 'Persuratan';
    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nomor')
                    ->maxLength(255),
                Forms\Components\Select::make('surat_id')
                    ->name('Type')
                    ->relationship(name: 'surat', titleAttribute: 'name')
                    ->afterStateUpdated(fn(Set $set, $state) => $set('data', collect(Surat::find($state)?->input_format ?? [])->where('type', 'form')->flatMap(fn($a) => [
                        $a['data']['key'] => '',
                    ])->toArray()))
                    ->live(onBlur: true)
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('user_id')
                    ->name('User')
                    ->required()
                    ->relationship(name: 'user', titleAttribute: 'name')
                    ->searchable()
                    ->preload(),
                  
                Forms\Components\Select::make('status')
                    ->required()
                    ->options(StatusPengajuanSurat::class)
                    ->afterStateUpdated(function(Set $set, Get $get, string $state) {
                        if ($state == StatusPengajuanSurat::Accepted->value) {
                            $set('verified_at', now()->toDateTimeString());
                        }
                    })
                    ->live(onBlur: true),
                Forms\Components\KeyValue::make('data')
                    ->required()
                    ->filled()
                    ->addable(false)
                    ->deletable(false),
                Forms\Components\DateTimePicker::make('verified_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('surat.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable(),
        
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn ($state): string => match ($state) {
                        StatusPengajuanSurat::Requested => 'warning',
                        StatusPengajuanSurat::Accepted => 'success',
                        StatusPengajuanSurat::Rejected => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('verified_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(StatusPengajuanSurat::class)
                    ->attribute('status_id'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(fn(Builder $query) => $query->with('user', 'surat'))
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            SignSuratsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengajuanSurats::route('/'),
            'create' => Pages\CreatePengajuanSurat::route('/create'),
            'edit' => Pages\EditPengajuanSurat::route('/{record}/edit'),
            'view' => Pages\ViewPengajuanSurat::route('/{record}'),
        ];
    }
}
