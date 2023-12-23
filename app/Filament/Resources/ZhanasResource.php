<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ZhanasResource\Pages;
use App\Filament\Resources\ZhanasResource\RelationManagers;
use App\Models\Corrected;
use App\Models\Zhanas;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ZhanasResource extends Resource
{
    protected static ?string $model = Zhanas::class;

    protected static ?string $navigationLabel = 'Жаңас';

    protected static ?string $label = 'Жаңас';

    protected static ?string $pluralModelLabel = 'Жаңас';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 2;

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
                Tables\Actions\Action::make('move')
                    ->label('Переместить в Исправленные')
                    ->action(fn (Zhanas $record) => static::moveRow($record))
                    ->requiresConfirmation()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('move-all')
                    ->label('Переместить все записи в Исправленные')
                    ->action(function ($records) {
                                static::moveAllRows($records);
                            })
                    ->requiresConfirmation()
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

    public static function moveAllRows($records): void
    {
        DB::transaction(function () use ($records) {
            $destinationData = [];
            foreach ($records as $record) {
                if ($record) {
                    $data = $record->toArray();
                    $word = $data['word'];
                    $exists = DB::table('correcteds')->where('word', $word)->exists();
                    if (!$exists) {
                        Corrected::create([
                            'word' => $word
                        ]);
                    }
                }
            }
            DB::table('zhanas')->delete();
        });

        Notification::make()
            ->title('Все записи успешно перемещены в Исправленные')
            ->success()
            ->send();
    }



    public static function moveRow(Zhanas $record)
    {
        DB::transaction(function () use ($record) {
            $destinationData = $record->toArray();
            $word = $destinationData['word'];
            $exists = DB::table('correcteds')->where('word', $word)->exists();
            if (!$exists) {
                Corrected::create([
                    'word' => $word
                ]);
            }
            $record->delete();
        });
        Notification::make('success')->title('Запись успешно перемещена в Исправленные')->send();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListZhanas::route('/'),
            'create' => Pages\CreateZhanas::route('/create'),
            'edit' => Pages\EditZhanas::route('/{record}/edit'),
        ];
    }
}
