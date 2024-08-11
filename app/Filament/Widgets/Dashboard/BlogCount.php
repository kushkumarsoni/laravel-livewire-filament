<?php

namespace App\Filament\Widgets\Dashboard;

use App\Models\Blog;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class BlogCount extends BaseWidget
{
    protected function getStats(): array
    {
        $allBlog            = Blog::count();
        $allPublishedBlog   = Blog::published()->count();
        $allUnPublishedBlog = Blog::where('status',0)->count();

        return [
            Stat::make('Total Blogs', $allBlog)
            ->description('increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('gray')
            ->extraAttributes([
                'class' => 'cursor-pointer',
            ])
            ->chart([7, 2, 10, 3, 15, 4, 17]),
            Stat::make('Published Blogs', $allPublishedBlog)
            ->description('increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->extraAttributes([
                'class' => 'cursor-pointer',
            ]),
            Stat::make('Not Published Blogs', $allUnPublishedBlog)
            ->description('increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('danger')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->extraAttributes([
                'class' => 'cursor-pointer',
            ]),
        ];
    }
}
