<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->placeholder('Enter name'),
                        TextInput::make('email')
                            ->placeholder('Enter email address')
                            ->label('Email address')
                            ->email()
                            ->required(),
                        TextInput::make('password')
                            ->placeholder('Enter password')
                            ->password()
                            ->required(),
                        Select::make('roles')
                            ->placeholder('Select role')
                            ->relationship('roles', 'name')
                            ->preload()
                            ->searchable(),

                    ])->columns(2)
                    ->columnSpanFull()
            ]);
    }
}
