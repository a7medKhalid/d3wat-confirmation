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
            Stat::make('زيارات الرابط', Confirmation::query()->count()),
            Stat::make('تأكيد حضور', Confirmation::query()->where('status', Confirmation::STATUS_CONFIRMED)->count()),
            Stat::make('اعتذار', Confirmation::query()->where('status', Confirmation::STATUS_DECLINED)->count()),
            Stat::make(
                'زيارات الفعالية النشطة',
                $activeSession
                    ? $activeSession->confirmations()->count()
                    : 0,
            )->description($activeSession?->title ?? 'لا توجد فعالية نشطة'),
        ];
    }
}
