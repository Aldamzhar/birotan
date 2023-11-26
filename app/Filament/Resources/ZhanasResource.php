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

class ZhanasResource extends Resource
{
    protected static ?string $model = Zhanas::class;

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
                    ->label('Move to Correcteds')
                    ->action(fn (Zhanas $record) => static::moveRow($record))
                    ->requiresConfirmation()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('move-all')
                    ->label('Move all to Correcteds')
                    ->action(function ($records) {
                                static::moveAllRows($records);
                            })
                    ->requiresConfirmation()
                ]),
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
            foreach ($records as $record) {
                if ($record) {
                    $destinationData = $record->toArray();
                    Corrected::create($destinationData);
                    $record->delete();
                }
            }
        });

        Notification::make()
            ->title('All records moved successfully to Corrected.')
            ->success()
            ->send();
    }



    public static function moveRow(Zhanas $record)
    {
        DB::transaction(function () use ($record) {
            // Here you can include the logic to move the data
            // Similar to the earlier provided moveRowToAnotherTable function

            $destinationData = $record->toArray();
            // Assuming DestinationModel is the model for the destination table
            Corrected::create($destinationData);
            $record->delete();
        });

        // Optionally, you can add a success message
        Notification::make('success')->title('Record moved successfully to Corrected.')->send();
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
