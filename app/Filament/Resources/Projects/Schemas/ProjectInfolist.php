<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;

class ProjectInfolist
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
                        TextEntry::make('start_date')
                            ->dateTime()
                            ->weight(FontWeight::Bold),
                        TextEntry::make('end_date')
                            ->dateTime()
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
                        TextEntry::make('creator.name')
                            ->weight(FontWeight::Bold)
                            ->label('Created by'),
                        TextEntry::make('updater.name')
                            ->weight(FontWeight::Bold)
                            ->label('Updated by'),
                        TextEntry::make('client.name')
                            ->label('Client')
                            ->weight(FontWeight::Bold),
                        TextEntry::make('category.name')
                            ->label('Category')
                            ->weight(FontWeight::Bold),
                        TextEntry::make('created_at')
                            ->dateTime('M d, Y h:i A')
                            ->timezone('Asia/Manila')
                            ->weight(FontWeight::Bold),
                        TextEntry::make('updated_at')
                            ->dateTime('M d, Y h:i A')
                            ->timezone('Asia/Manila')
                            ->weight(FontWeight::Bold),

                    ])->columnSpanFull()
            ]);
    }
}
