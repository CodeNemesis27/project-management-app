<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;

class ListProjects extends ListRecords
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('All')
                ->badge(fn() => $this->getTableQuery()->count()),
            'Pending' => Tab::make()
                ->label('Pending')
                ->badge(fn() => $this->getTableQuery()->where('status', 'Pending')->count())
                ->query(fn($query) => $query->where('status', 'Pending')),
            'On hold' => Tab::make()
                ->label('On hold')
                ->badge(fn() => $this->getTableQuery()->where('status', 'On hold')->count())
                ->query(fn($query) => $query->where('status', 'On hold')),
            'In progress' => Tab::make()
                ->label('In progress')
                ->badge(fn() => $this->getTableQuery()->where('status', 'In progress')->count())
                ->query(fn($query) => $query->where('status', 'In progress')),
            'Completed' => Tab::make()
                ->label('Completed')
                ->badge(fn() => $this->getTableQuery()->where('status', 'Completed')->count())
                ->query(fn($query) => $query->where('status', 'Completed')),
            'Cancelled' => Tab::make()
                ->label('Cancelled')
                ->badge(fn() => $this->getTableQuery()->where('status', 'Cancelled')->count())
                ->query(fn($query) => $query->where('status', 'Cancelled')),
        ];
    }
}
