<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SongsResource\Pages;
use App\Filament\Resources\SongsResource\RelationManagers;
use App\Models\Songs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SongsResource extends Resource
{
    protected static ?string $model = Songs::class;

    protected static ?string $navigationLabel = 'БірОтан әуені';

    protected static ?string $label = 'БірОтан әуені';

    protected static ?string $pluralModelLabel = 'БірОтан әуені';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->label('Название')->required()->maxLength(255),
                Forms\Components\Textarea::make('description')->label('Описание'),
                Forms\Components\TextInput::make('author_name')->label('Имя автора')->required()->maxLength(255),
                Forms\Components\DatePicker::make('publication_date')->label('Дата публикации'),
                Forms\Components\TextInput::make('youtube_link')->label('Youtube-ссылка')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Название')->searchable(),
                Tables\Columns\TextColumn::make('description')->label('Описание')->searchable(),
                Tables\Columns\TextColumn::make('author_name')->label('Имя автора')->searchable(),
                Tables\Columns\TextColumn::make('publication_date')->label('Дата публикации')->sortable(),
                Tables\Columns\TextColumn::make('youtube_link')->label('Youtube-ссылка')
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListSongs::route('/'),
            'create' => Pages\CreateSongs::route('/create'),
            'edit' => Pages\EditSongs::route('/{record}/edit'),
        ];
    }
}
