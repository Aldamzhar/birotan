<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Models\Book;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Forms\Components\FileUploadWithExtraction;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $label = 'Книги';
    protected static ?string $pluralModelLabel = 'Книги';
    protected static ?string $navigationLabel = 'Книга';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Название')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Описание')
                    ->required(),
                Forms\Components\FileUpload::make('file_path')
                    ->label('Файл')
                    ->directory('uploads/books')
                    ->disk('public')
                    ->visibility('public')
                    ->acceptedFileTypes(['application/pdf'])
                    ->downloadable()
                    ->openable()
                    ->required()
                    ->maxFiles(1),
                Forms\Components\TextInput::make('price')
                    ->label('Цена')
                    ->required()
                    ->numeric(),
                Forms\Components\Checkbox::make('is_preview_enabled')
                    ->label('Бесплатный просмотр'),
                Forms\Components\TextInput::make('preview_pages_count')
                    ->label('Кол-во страниц для бесплатного просмотра')
                    ->numeric()
                    ->default(10),
            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Название')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('description')->label('Описание')->limit(50),
                Tables\Columns\TextColumn::make('price')->label('Цена')->sortable(),
                Tables\Columns\ViewColumn::make('file_path')
                    ->label('Файл')
                    ->view('tables.columns.file-download'),
                Tables\Columns\IconColumn::make('is_preview_enabled')->label('Бесплатный просмотр')->boolean(),
                Tables\Columns\TextColumn::make('preview_pages_count')->label('Страниц для просмотра'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'view' => Pages\ViewBook::route('/{record}'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
