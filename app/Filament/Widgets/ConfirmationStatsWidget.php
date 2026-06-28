<?php

namespace App\Filament\Widgets;

use App\Models\Confirmation;
use App\Models\ConfirmationSession;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ConfirmationStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $activeSession = ConfirmationSession::active();

        return [
            Stat::make('إجمالي التأكيدات', Confirmation::query()->count()),
            Stat::make('تأكيدات اليوم', Confirmation::query()->whereDate('confirmed_at', today())->count()),
            Stat::make(
                'تأكيدات الفعالية النشطة',
                $activeSession
                    ? $activeSession->confirmations()->count()
                    : 0,
            )->description($activeSession?->title ?? 'لا توجد فعالية نشطة'),
        ];
    }
}
