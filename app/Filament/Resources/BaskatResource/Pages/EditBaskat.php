<?php

namespace App\Filament\Resources\BaskatResource\Pages;

use App\Filament\Resources\BaskatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBaskat extends EditRecord
{
    protected static string $resource = BaskatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
