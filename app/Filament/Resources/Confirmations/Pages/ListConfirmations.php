<?php

namespace App\Filament\Resources\Confirmations\Pages;

use App\Filament\Resources\Confirmations\ConfirmationResource;
use Filament\Resources\Pages\ListRecords;

class ListConfirmations extends ListRecords
{
    protected static string $resource = ConfirmationResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
