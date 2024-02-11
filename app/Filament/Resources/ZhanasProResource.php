<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ZhanasProResource\Pages;
use App\Models\Corrected;
use App\Models\CorrectedPro;
use App\Models\Zhanas;
use App\Models\ZhanasPro;
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

class ZhanasProResource extends Resource
{
    protected static ?string $model = ZhanasPro::class;

    protected static ?string $navigationLabel = 'ЖаңасPRO';

    protected static ?string $label = 'ЖаңасPRO';

    protected static ?string $pluralModelLabel = 'ЖаңасPRO';

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
                    ->label('Переместить в ИсправленныеPRO')
                    ->action(fn (ZhanasPro $record) => static::moveRow($record))
                    ->requiresConfirmation()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('move-all')
                        ->label('Переместить все записи в ИсправленныеPRO')
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
                    $exists = DB::table('corrected_pros')->where('word', $word)->exists();
                    if (!$exists) {
                        CorrectedPro::create([
                            'word' => $word
                        ]);
                    }
                }
            }
            DB::table('zhanas_pros')->delete();
        });

        Notification::make()
            ->title('Все записи успешно перемещены в ИсправленныеPRO')
            ->success()
            ->send();
    }



    public static function moveRow(ZhanasPro $record)
    {
        DB::transaction(function () use ($record) {
            $destinationData = $record->toArray();
            $word = $destinationData['word'];
            $exists = DB::table('corrected_pros')->where('word', $word)->exists();
            if (!$exists) {
                CorrectedPro::create([
                    'word' => $word
                ]);
            }
            $record->delete();
        });
        Notification::make('success')->title('Запись успешно перемещена в ИсправленныеPRO')->send();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListZhanasPros::route('/'),
            'create' => Pages\CreateZhanasPro::route('/create'),
            'edit' => Pages\EditZhanasPro::route('/{record}/edit'),
        ];
    }
}
