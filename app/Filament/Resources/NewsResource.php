<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationLabel = 'Tech+жаңалық';

    protected static ?string $label = 'Tech+жаңалық';

    protected static ?string $pluralModelLabel = 'Tech+жаңалық';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->label('Название')->required()->maxLength(255),
                Forms\Components\Textarea::make('description')->label('Описание'),
                Forms\Components\TextInput::make('author_name')->label('Имя автора')->required()->maxLength(255),
                Forms\Components\TextInput::make('link')->label('Ссылка на новость'),
                Forms\Components\DatePicker::make('publication_date')->label('Дата публикации'),
                Forms\Components\FileUpload::make('img')->label('Картинка')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Название')->searchable(),
                Tables\Columns\TextColumn::make('description')->label('Описание')->searchable(),
                Tables\Columns\TextColumn::make('author_name')->label('Имя автора')->searchable(),
                Tables\Columns\TextColumn::make('link')->label('Ссылка на новость')->searchable(),
                Tables\Columns\TextColumn::make('publication_date')->label('Дата публикации')->sortable(),
                Tables\Columns\ImageColumn::make('img')->label('Картинка')
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
