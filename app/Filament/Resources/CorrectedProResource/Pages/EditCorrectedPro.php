<?php

namespace App\Filament\Resources\CorrectedProResource\Pages;

use App\Filament\Resources\CorrectedProResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCorrectedPro extends EditRecord
{
    protected static string $resource = CorrectedProResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
