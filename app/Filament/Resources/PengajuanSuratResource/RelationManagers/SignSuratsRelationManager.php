<?php

namespace App\Filament\Resources\PengajuanSuratResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SignSuratsRelationManager extends RelationManager
{
    protected static string $relationship = 'signSurats';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('signature_code')
                    ->default(fn () => \Illuminate\Support\Str::random(10))
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('file_link')
                    ->label('File')
                    ->url(fn ($record) => $record->original_filepath ? asset('storage/' . $record->original_filepath) : null)
                    ->getStateUsing(fn ($record) => $record->original_filepath ? $record->original_filename : 'No file')
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-document-text')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
