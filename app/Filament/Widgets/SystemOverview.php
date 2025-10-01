<?php

namespace App\Filament\Widgets;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SystemOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Number of Users', User::count()),
            Stat::make('Number of Clients', Client::count()),
            Stat::make('Number of Projects', Project::count()),
            Stat::make('Number of Tasks', Task::count()),
        ];
    }
}
