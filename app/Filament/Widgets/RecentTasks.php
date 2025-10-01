<?php

namespace App\Filament\Widgets;

use App\Models\Task;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;


class RecentTasks extends TableWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn(): Builder => Task::query())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('category.name'),
                TextColumn::make('project.name'),
                TextColumn::make('assigned_user.name'),
                TextColumn::make('priority')
                    ->badge(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Pending' => 'info',
                        'On hold' => 'info',
                        'In progress' => 'warning',
                        'Completed' => 'success',
                        'Cancelled' => 'danger',
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
