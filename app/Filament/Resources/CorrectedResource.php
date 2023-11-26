<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CorrectedResource\Pages;
use App\Filament\Resources\CorrectedResource\RelationManagers;
use App\Models\Baskat;
use App\Models\Corrected;
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

class CorrectedResource extends Resource
{
    protected static ?string $model = Corrected::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('word')->required()->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('word')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('move')
                    ->label('Move to Baskat')
                    ->action(fn (Corrected $record) => static::moveRow($record))
                    ->requiresConfirmation()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('move-all')
                        ->label('Move all to Baskats')
                        ->action(function ($records) {
                            static::moveAllRows($records);
                        })
                        ->requiresConfirmation()
                ]),
            ]);
    }

    public static function moveRow(Corrected $record)
    {
        DB::transaction(function () use ($record) {
            // Here you can include the logic to move the data
            // Similar to the earlier provided moveRowToAnotherTable function

            $destinationData = $record->toArray();
            // Assuming DestinationModel is the model for the destination table
            Baskat::create($destinationData);
            $record->delete();
        });

        // Optionally, you can add a success message
        Notification::make('success')->title('Record moved successfully to Baskat.')->send();
    }

    public static function moveAllRows($records): void
    {
        DB::transaction(function () use ($records) {
            foreach ($records as $record) {
                if ($record) {
                    $destinationData = $record->toArray();
                    Baskat::create($destinationData);
                    $record->delete();
                }
            }
        });

        Notification::make()
            ->title('All records moved successfully to Baskat.')
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
            'index' => Pages\ListCorrecteds::route('/'),
            'create' => Pages\CreateCorrected::route('/create'),
            'edit' => Pages\EditCorrected::route('/{record}/edit'),
        ];
    }
}