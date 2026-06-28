<?php

namespace App\Filament\Resources\ConfirmationSessions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ConfirmationSessionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('عنوان الفعالية')
                    ->required()
                    ->maxLength(255),
                Toggle::make('is_active')
                    ->label('فعالية نشطة')
                    ->helperText('يمكن أن تكون فعالية واحدة نشطة فقط. الرابط العام /confirm يوجّه للفعالية النشطة.'),
                TextEntry::make('public_link')
                    ->label('رابط التأكيد العام')
                    ->state(fn (): string => rtrim(config('app.url'), '/').'/confirm')
                    ->helperText('انسخ هذا الرابط وألصقه في مرسل التذكير (وضع الرابط الموحد).'),
                TextEntry::make('uuid')
                    ->label('المعرف الداخلي')
                    ->visible(fn (string $operation): bool => $operation === 'edit'),
            ]);
    }
}
