<?php

namespace App\Filament\Resources\CorrectedProResource\Pages;

use App\Filament\Resources\CorrectedProResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCorrectedPros extends ListRecords
{
    protected static string $resource = CorrectedProResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
