<?php

namespace App\Filament\Resources\ConfirmationSessions\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
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
                Placeholder::make('public_url')
                    ->label('رابط التأكيد العام')
                    ->content(fn (): string => rtrim(config('app.url'), '/').'/confirm')
                    ->helperText('انسخ هذا الرابط وألصقه في مرسل التذكير (وضع الرابط الموحد).'),
                Placeholder::make('uuid')
                    ->label('المعرف الداخلي')
                    ->content(fn (?string $state): string => $state ?? '—')
                    ->visible(fn (?string $state): bool => filled($state)),
            ]);
    }
}
