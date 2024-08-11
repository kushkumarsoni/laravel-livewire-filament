<?php

namespace App\Filament\Widgets\Dashboard;

use App\Models\Service;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ServiceCount extends BaseWidget
{
    protected function getStats(): array
    {
        $allService            = Service::count();
        $allPublishedService   = Service::published()->count();
        $allUnPublishedService = Service::where('status',0)->count();

        return [
            Stat::make('Total Services', $allService)
            ->description('increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('gray')
            ->extraAttributes([
                'class' => 'cursor-pointer',
            ]),
            Stat::make('Published Services', $allPublishedService)
            ->description('increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
            Stat::make('Not Published Services', $allUnPublishedService)
            ->description('increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('danger'),
        ];
    }
}
