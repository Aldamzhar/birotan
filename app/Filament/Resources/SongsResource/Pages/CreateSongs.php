<?php

namespace App\Filament\Resources\SongsResource\Pages;

use App\Filament\Resources\SongsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSongs extends CreateRecord
{
    protected static string $resource = SongsResource::class;
}
