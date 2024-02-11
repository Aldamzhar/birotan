<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CorrectedProResource\Pages;
use App\Models\Baskat;
use App\Models\BaskatPro;
use App\Models\Corrected;
use App\Models\CorrectedPro;
use App\Models\Zhanas;
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

class CorrectedProResource extends Resource
{
    protected static ?string $model = CorrectedPro::class;

    protected static ?string $navigationLabel = 'ИсправленныеPRO';

    protected static ?string $label = 'ИсправленныеPRO';

    protected static ?string $pluralModelLabel = 'ИсправленныеPRO';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 3;

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
                    ->label('Переместить в БаскатPRO')
                    ->action(fn (CorrectedPro $record) => static::moveRow($record))
                    ->requiresConfirmation()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('move-all')
                        ->label('Переместить все записи в БаскатPRO')
                        ->action(function ($records) {
                            static::moveAllRows($records);
                        })
                        ->requiresConfirmation()
                ]),
                ExportBulkAction::make()
            ]);
    }

    public static function moveRow(CorrectedPro $record)
    {
        DB::transaction(function () use ($record) {
            $destinationData = $record->toArray();
            $word = $destinationData['word'];
            $exists = DB::table('baskat_pros')->where('word', $word)->exists();
            if (!$exists) {
                BaskatPro::create([
                    'word' => $word
                ]);
            }
            $record->delete();
        });
        Notification::make('success')->title('Запись успешно перемещена в БаскатPRO')->send();
    }

    public static function moveAllRows($records): void
    {
        DB::transaction(function () use ($records) {
            foreach ($records as $record) {
                if ($record) {
                    $data = $record->toArray();
                    $word = $data['word'];
                    $exists = DB::table('baskat_pros')->where('word', $word)->exists();
                    if (!$exists) {
                        BaskatPro::create([
                            'word' => $word
                        ]);
                    }
                }
            }
            DB::table('corrected_pros')->delete();
        });

        Notification::make()
            ->title('Все записи успешно перемещены в БаскатPRO')
            ->success()
            ->send();
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
            'index' => Pages\ListCorrectedPros::route('/'),
            'create' => Pages\CreateCorrectedPro::route('/create'),
            'edit' => Pages\EditCorrectedPro::route('/{record}/edit'),
        ];
    }
}
