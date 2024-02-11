<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BaskatProResource\Pages;
use App\Models\Baskat;
use App\Models\BaskatPro;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class BaskatProResource extends Resource
{
    protected static ?string $model = BaskatPro::class;

    protected static ?string $label = 'БаскатPRO';

    protected static ?string $pluralModelLabel = 'БаскатPRO';

    protected static ?string $navigationLabel = 'БаскатPRO';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('word')->label('Слово')->required()->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('word')->label('Слово')->searchable()->sortable(),
            ])
            ->defaultSort('word')
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
                ExportBulkAction::make()
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
            'index' => Pages\ListBaskatPros::route('/'),
            'create' => Pages\CreateBaskatPro::route('/create'),
            'edit' => Pages\EditBaskatPro::route('/{record}/edit'),
        ];
    }
}
