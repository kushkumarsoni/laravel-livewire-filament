<?php

namespace App\Filament\Widgets\Dashboard;

use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class CategoryCount extends BaseWidget
{
    protected function getStats(): array
    {
        $allCategory            = Category::count();
        $allPublishedCategory   = Category::published()->count();
        $allUnPublishedCategory = Category::where('status',0)->count();

        return [
            Stat::make('Total Categories', $allCategory)
            ->description('increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('gray')
            ->extraAttributes([
                'class' => 'cursor-pointer',
            ]),
            Stat::make('Published Categories', $allPublishedCategory)
            ->description('increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
            Stat::make('Not Published Categories', $allUnPublishedCategory)
            ->description('increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('danger'),
        ];
    }
}
