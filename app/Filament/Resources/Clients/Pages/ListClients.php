<?php

namespace App\Filament\Resources\Clients\Pages;

use App\Filament\Resources\Clients\ClientResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;


class ListClients extends ListRecords
{
    protected static string $resource = ClientResource::class;

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
            'Active' => Tab::make()
                ->label('Active')
                ->badge(fn() => $this->getTableQuery()->where('status', 'Active')->count())
                ->query(fn($query) => $query->where('status', 'Active')),
            'Inactive' => Tab::make()
                ->label('Inactive')
                ->badge(fn() => $this->getTableQuery()->where('status', 'Inactive')->count())
                ->query(fn($query) => $query->where('status', 'Inactive')),
        ];
    }
}
