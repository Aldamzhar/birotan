<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BaskatResource\Pages;
use App\Filament\Resources\BaskatResource\RelationManagers;
use App\Models\Baskat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class BaskatResource extends Resource
{
    protected static ?string $model = Baskat::class;

    protected static ?string $label = 'Баскат';

    protected static ?string $pluralModelLabel = 'Баскат';

    protected static ?string $navigationLabel = 'Баскат';

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
                Tables\Columns\TextColumn::make('word')->label('Слово')->searchable(),
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
            'index' => Pages\ListBaskats::route('/'),
            'create' => Pages\CreateBaskat::route('/create'),
            'edit' => Pages\EditBaskat::route('/{record}/edit'),
        ];
    }
}
