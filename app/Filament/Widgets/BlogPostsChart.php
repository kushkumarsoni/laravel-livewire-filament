<?php

namespace App\Filament\Widgets;

use App\Models\Blog;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class BlogPostsChart extends ChartWidget
{
    protected static ?string $heading = 'Blog Posts';
    protected static string $color = 'info';
    //public ?string $filter = 'today';
    protected static ?string $maxHeight = '250px';
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
       // $activeFilter = $this->filter;
        $data = Trend::model(Blog::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    // protected function getFilters(): ?array
    // {
    //     return [
    //         'today' => 'Today',
    //         'week' => 'Last week',
    //         'month' => 'Last month',
    //         'year' => 'This year',
    //     ];
    // }
}
