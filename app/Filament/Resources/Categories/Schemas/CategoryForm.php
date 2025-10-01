<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Category details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->placeholder('Enter category name'),
                        Select::make('type')
                            ->placeholder('Select category type')
                            ->options(['Project' => 'Project', 'Task' => 'Task'])
                            ->required(),
                        Textarea::make('description')
                            ->placeholder('Enter category description')
                            ->columnSpanFull(),

                    ])
                    ->columnSpanFull()
                    ->columns(2)
            ]);
    }
}
