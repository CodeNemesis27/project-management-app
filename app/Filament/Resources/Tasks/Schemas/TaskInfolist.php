<?php

namespace App\Filament\Resources\Tasks\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;

class TaskInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make()
                    ->schema([
                        ImageEntry::make('image_path')
                            ->label('Image')
                            ->disk('public')
                            ->columnSpanFull(),
                        TextEntry::make('name')
                            ->weight(FontWeight::Bold),
                        TextEntry::make('category.name')
                            ->label('Category')
                            ->weight(FontWeight::Bold),
                        TextEntry::make('project.name')
                            ->label('Project name')
                            ->weight(FontWeight::Bold),
                        TextEntry::make('due_date')
                            ->weight(FontWeight::Bold),
                        TextEntry::make('priority')
                            ->weight(FontWeight::Bold),
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'Pending' => 'info',
                                'On hold' => 'info',
                                'In progress' => 'warning',
                                'Completed' => 'success',
                                'Cancelled' => 'danger',
                            })
                            ->weight(FontWeight::Bold),
                        TextEntry::make('assigned_user.name')
                            ->label('Assigned user')
                            ->weight(FontWeight::Bold),
                        TextEntry::make('creator.name')
                            ->label('Created by')
                            ->weight(FontWeight::Bold),
                        TextEntry::make('updater.name')
                            ->label('Updated by')
                            ->weight(FontWeight::Bold),
                        TextEntry::make('created_at')
                            ->weight(FontWeight::Bold)
                            ->dateTime('M d, Y h:i A')
                            ->timezone('Asia/Manila'),
                        TextEntry::make('updated_at')
                            ->weight(FontWeight::Bold)
                            ->dateTime('M d, Y h:i A')
                            ->timezone('Asia/Manila'),

                    ])->columnSpanFull()
            ]);
    }
}
