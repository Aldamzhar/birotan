<?php

namespace App\Filament\Resources\BaskatProResource\Pages;

use App\Filament\Resources\BaskatProResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBaskatPro extends EditRecord
{
    protected static string $resource = BaskatProResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
