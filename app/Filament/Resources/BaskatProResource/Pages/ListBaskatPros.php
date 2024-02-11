<?php

namespace App\Filament\Resources\BaskatProResource\Pages;

use App\Filament\Resources\BaskatProResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBaskatPros extends ListRecords
{
    protected static string $resource = BaskatProResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
