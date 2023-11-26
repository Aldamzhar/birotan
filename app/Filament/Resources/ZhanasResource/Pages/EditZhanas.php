<?php

namespace App\Filament\Resources\ZhanasResource\Pages;

use App\Filament\Resources\ZhanasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditZhanas extends EditRecord
{
    protected static string $resource = ZhanasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
