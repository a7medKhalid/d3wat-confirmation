<?php

namespace App\Filament\Resources\ConfirmationSessions\Pages;

use App\Filament\Resources\ConfirmationSessions\ConfirmationSessionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditConfirmationSession extends EditRecord
{
    protected static string $resource = ConfirmationSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
