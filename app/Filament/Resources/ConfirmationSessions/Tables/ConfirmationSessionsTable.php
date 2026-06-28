<?php

namespace App\Filament\Resources\ConfirmationSessions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ConfirmationSessionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('العنوان')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('نشطة')
                    ->boolean(),
                TextColumn::make('confirmations_count')
                    ->label('إجمالي التأكيدات')
                    ->counts('confirmations')
                    ->sortable(),
                TextColumn::make('public_url')
                    ->label('الرابط العام')
                    ->state(fn (): string => rtrim(config('app.url'), '/').'/confirm')
                    ->copyable()
                    ->copyMessage('تم نسخ الرابط'),
                TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
