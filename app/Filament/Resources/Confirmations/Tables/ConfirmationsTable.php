<?php

namespace App\Filament\Resources\Confirmations\Tables;

use App\Models\Confirmation;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ConfirmationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('mode')
                    ->label('النوع')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => $state === Confirmation::MODE_SESSION ? 'جلسة' : 'مباشر')
                    ->color(fn (string $state): string => $state === Confirmation::MODE_SESSION ? 'info' : 'success'),
                TextColumn::make('confirmationSession.title')
                    ->label('الفعالية')
                    ->placeholder('—')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('الاسم')
                    ->placeholder('—')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('الجوال')
                    ->placeholder('—')
                    ->searchable(),
                TextColumn::make('confirmed_at')
                    ->label('وقت التأكيد')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('ip_address')
                    ->label('IP')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('confirmed_at', 'desc')
            ->filters([
                SelectFilter::make('mode')
                    ->label('النوع')
                    ->options([
                        Confirmation::MODE_DIRECT => 'مباشر',
                        Confirmation::MODE_SESSION => 'جلسة',
                    ]),
                SelectFilter::make('confirmation_session_id')
                    ->label('الفعالية')
                    ->relationship('confirmationSession', 'title'),
            ])
            ->headerActions([
                Action::make('exportCsv')
                    ->label('تصدير CSV')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(fn (): StreamedResponse => static::exportCsv()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function exportCsv(): StreamedResponse
    {
        $filename = 'confirmations-'.now()->format('Ymd-His').'.csv';

        return response()->streamDownload(function (): void {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($handle, ['mode', 'session', 'name', 'phone', 'confirmed_at', 'ip_address']);

            Confirmation::query()
                ->with('confirmationSession')
                ->orderByDesc('confirmed_at')
                ->chunk(200, function ($rows) use ($handle): void {
                    foreach ($rows as $row) {
                        fputcsv($handle, [
                            $row->mode,
                            $row->confirmationSession?->title,
                            $row->name,
                            $row->phone,
                            $row->confirmed_at?->toDateTimeString(),
                            $row->ip_address,
                        ]);
                    }
                });

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
