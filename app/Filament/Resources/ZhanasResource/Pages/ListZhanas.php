<?php

namespace App\Filament\Resources\ZhanasResource\Pages;

use App\Filament\Resources\ZhanasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListZhanas extends ListRecords
{
    protected static string $resource = ZhanasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
