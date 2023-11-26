<?php

namespace App\Filament\Resources\SongsResource\Pages;

use App\Filament\Resources\SongsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSongs extends ListRecords
{
    protected static string $resource = SongsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
