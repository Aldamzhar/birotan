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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->required()->maxLength(255),
                Forms\Components\Textarea::make('description'),
                Forms\Components\TextInput::make('author_name')->required()->maxLength(255),
                Forms\Components\DatePicker::make('publication_date'),
                Forms\Components\TextInput::make('youtube_link')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('description')->searchable(),
                Tables\Columns\TextColumn::make('author_name')->searchable(),
                Tables\Columns\TextColumn::make('publication_date')->sortable(),
                Tables\Columns\TextColumn::make('youtube_link')
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
