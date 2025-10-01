<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;

class ClientInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->weight(FontWeight::Bold),
                TextEntry::make('email')
                    ->weight(FontWeight::Bold)
                    ->label('Email address'),
                TextEntry::make('phone')
                    ->weight(FontWeight::Bold),
                TextEntry::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Active' => 'success',
                        'Inactive' => 'danger',
                    })
                    ->weight(FontWeight::Bold),
                TextEntry::make('creator.name')
                    ->weight(FontWeight::Bold)
                    ->label('Created by'),
                TextEntry::make('updater.name')
                    ->weight(FontWeight::Bold)
                    ->label('Updated by'),
                TextEntry::make('created_at')
                    ->weight(FontWeight::Bold)
                    ->dateTime('M d, Y h:i A')
                    ->timezone('Asia/Manila'),
                TextEntry::make('updated_at')
                    ->dateTime('M d, Y h:i A')
                    ->timezone('Asia/Manila')
                    ->weight(FontWeight::Bold),
            ]);
    }
}
