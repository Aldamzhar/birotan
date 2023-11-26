<?php

namespace App\Filament\Resources\BaskatResource\Pages;

use App\Filament\Resources\BaskatResource;
use App\Models\Baskat;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\Actions\ImportField;

class ListBaskats extends ListRecords
{
    protected static string $resource = BaskatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportAction::make('Импорт')->fields([
                ImportField::make('word')->required()
            ])->uniqueField('word'),
        ];
    }
}
