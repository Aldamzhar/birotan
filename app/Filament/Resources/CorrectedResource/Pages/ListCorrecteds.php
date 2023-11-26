<?php

namespace App\Filament\Resources\CorrectedResource\Pages;

use App\Filament\Resources\CorrectedResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCorrecteds extends ListRecords
{
    protected static string $resource = CorrectedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
