<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuratResource\Pages;
use App\Filament\Resources\SuratResource\RelationManagers;
use App\Models\Surat;
use Filament\Forms;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use ReflectionClass;
use ReflectionMethod;

class SuratResource extends Resource
{
    protected static ?string $navigationLabel = 'Kelola Surat';
    protected static ?string $label = 'Surat';
    protected static ?string $model = Surat::class;
    protected static ?string $modelLabel = 'Surat';
    protected static ?string $navigationGroup = 'Persuratan';
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->afterStateUpdated(fn(Set $set, $state) => $set('slug', str()->slug($state)))
                    ->live(onBlur: true)
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required(),
                SpatieMediaLibraryFileUpload::make('file')
                    ->acceptedFileTypes([
                        'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    ])
                    ->directory('surat')
                    ->required()
                    ->collection('file')
                    ->disk('public')
                    ->openable()
                    ->downloadable()
                    ->previewable(false),
                Forms\Components\Section::make('Value Replacer')
                    ->description(new HtmlString(
                        'Informasi yang didapatkan akan menjadi data output untuk surat yang dihasilkan'
                    ))
                    ->columns(2)
                    ->schema([
                        Forms\Components\Builder::make('input_format')
                            ->blocks([
                                Forms\Components\Builder\Block::make('form')
                                    ->schema([
                                        Forms\Components\TextInput::make('key')
                                            ->required(),
                                        Forms\Components\TagsInput::make('rules')
                                            ->required()
                                            ->suggestions(function() {
                                                $validatorClass = new ReflectionClass(\Illuminate\Validation\Concerns\ValidatesAttributes::class);

                                                return collect($validatorClass->getMethods(ReflectionMethod::IS_PUBLIC))
                                                ->filter(function($method){
                                                    return str()->startsWith($method->name,'validate');
                                                })
                                                ->map(function($method){
                                                    return str_replace('validate_', '', str()->snake($method->name));
                                                });
                                            }),
                                    ])
                            ]),
                        KeyValue::make('value_format')
                            ->addActionLabel('Tambahkan Aturan')
                            ->keyPlaceholder('format')
                            ->valuePlaceholder('{{value}}'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
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
                //
            ])
            ->actions([
                Tables\Actions\Action::make('file')
                    ->icon('heroicon-o-document-text')
                    ->url(fn(Surat $record) => $record->getFirstMediaUrl('file'))
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSurats::route('/'),
            'create' => Pages\CreateSurat::route('/create'),
            'edit' => Pages\EditSurat::route('/{record}/edit'),
        ];
    }
}
