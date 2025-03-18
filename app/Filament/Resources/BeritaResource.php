<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeritaResource\Pages;
use App\Filament\Resources\BeritaResource\RelationManagers;
use App\Models\Berita;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Http\UploadedFile;
use Rawilk\FilamentQuill\Filament\Forms\Components\QuillEditor;

class BeritaResource extends Resource
{
    protected static ?string $navigationLabel = 'Kelola Berita & Wisata';
    protected static ?string $label = 'Berita';
    protected static ?string $model = Berita::class;
    protected static ?string $modelLabel = 'Berita';
    protected static ?string $navigationGroup = 'Pengelolaan';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SpatieMediaLibraryFileUpload::make('thumbnail')
                    ->collection('thumbnail')
                    ->disk('public')
                    ->directory('berita')
                    ->image()
                    ->imageEditor()
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('title')
                    ->afterStateUpdated(fn(Set $set, $state) => $set('slug', str()->slug($state)))
                    ->live(onBlur: true)
                    ->required(),
                Forms\Components\TextInput::make('slug')
                    ->required(),
                Forms\Components\Textarea::make('headline')
                    ->maxLength(255)
                    ->required(),
                QuillEditor::make('content')
                    ->required()
                    ->fileAttachmentsDirectory('berita')
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsVisibility('public')
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('published_at')
                    ->default(now())
                    ->required(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                SpatieMediaLibraryImageEntry::make('thumbnail')
                    ->collection('thumbnail')
                    ->columnSpanFull(),
                TextEntry::make('title')
                    ->limit(50),
                TextEntry::make('slug')
                    ->limit(50),
                TextEntry::make('headline'),
                TextEntry::make('published_by')
                    ->limit(50),
                TextEntry::make('published_user_id')
                    ->numeric(),
                TextEntry::make('published_at')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('headline')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('published_by')
                    ->searchable(),
                Tables\Columns\TextColumn::make('published_user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_at')
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
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'view' => Pages\ViewBerita::route('/{record}'),
            'edit' => Pages\EditBerita::route('/{record}/edit'),
        ];
    }
}
