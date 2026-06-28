<?php

namespace App\Filament\Resources\ConfirmationSessions\Pages;

use App\Filament\Resources\ConfirmationSessions\ConfirmationSessionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListConfirmationSessions extends ListRecords
{
    protected static string $resource = ConfirmationSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
