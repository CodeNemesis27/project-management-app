<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Client details')
                    ->schema([
                        TextInput::make('name')
                            ->columnSpan(2)
                            ->placeholder('Enter client name')
                            ->required(),
                        TextInput::make('email')
                            ->label('Email address')
                            ->placeholder('Enter client email address')
                            ->email()
                            ->columnSpan(2)
                            ->required(),
                        TextInput::make('phone')
                            ->tel()
                            ->placeholder('Enter client phone')
                            ->columnSpan(2),
                        Textarea::make('address')
                            ->columnSpanFull()
                            ->placeholder('Enter client address'),
                        Select::make('status')
                            ->placeholder('Select client status')
                            ->options([
                                'Active' => 'Active',
                                'Inactive' => 'Inactive'
                            ])
                            ->default('Active')
                            ->columnSpan(2)
                            ->required(),
                        Select::make('created_by')
                            ->columnSpan(2)
                            ->relationship('creator', 'name')
                            ->required()
                            ->default(Auth::user()->id)
                            ->disabled()
                            ->dehydrated(true)
                            ->searchable()
                            ->preload(),
                        Select::make('updated_by')
                            ->columnSpan(2)
                            ->relationship('updater', 'name')
                            ->required()
                            ->default(Auth::user()->id)
                            ->disabled()
                            ->dehydrated(true)
                            ->preload()
                            ->searchable(),

                    ])
                    ->columns(6)
                    ->columnSpanFull()
            ]);
    }
}
