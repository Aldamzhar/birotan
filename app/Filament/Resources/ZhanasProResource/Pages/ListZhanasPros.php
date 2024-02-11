<?php

namespace App\Filament\Resources\ZhanasProResource\Pages;

use App\Filament\Resources\ZhanasProResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListZhanasPros extends ListRecords
{
    protected static string $resource = ZhanasProResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
