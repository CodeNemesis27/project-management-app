<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

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
            'Project' => Tab::make()
                ->label('Project')
                ->badge(fn() => $this->getTableQuery()->where('type', 'Project')->count())
                ->query(fn($query) => $query->where('type', 'Project')),
            'Task' => Tab::make()
                ->label('Task')
                ->badge(fn() => $this->getTableQuery()->where('type', 'Task')->count())
                ->query(fn($query) => $query->where('type', 'Task')),
        ];
    }
}
