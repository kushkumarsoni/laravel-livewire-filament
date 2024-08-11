<?php

namespace App\Filament\Widgets\Dashboard;

use App\Models\Member;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class MemberCount extends BaseWidget
{
    protected function getStats(): array
    {
        $allMember              = Member::count();
        $allPublishedMember     = Member::published()->count();
        $allUnPublishedMember   = Member::where('status',0)->count();

        return [
            Stat::make('Total Members', $allMember)
            ->description('increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('gray')
            ->extraAttributes([
                'class' => 'cursor-pointer',
            ]),
            Stat::make('Published Members', $allPublishedMember)
            ->description('increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
            Stat::make('Not Published Members', $allUnPublishedMember)
            ->description('increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('danger'),
        ];
    }
}
