<?php

namespace App\Filament\Resources\CorrectedResource\Pages;

use App\Filament\Resources\CorrectedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCorrected extends EditRecord
{
    protected static string $resource = CorrectedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
