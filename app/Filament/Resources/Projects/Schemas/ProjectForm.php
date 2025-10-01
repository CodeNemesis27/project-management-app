<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\CategoryType;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Project details')
                            ->schema([
                                TextInput::make('name')
                                    ->placeholder('Enter project name')
                                    ->required(),
                                Select::make('client_id')
                                    ->placeholder('Select client')
                                    ->relationship('client', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload(),
                                Textarea::make('description')
                                    ->placeholder('Enter project description')
                                    ->columnSpanFull(),
                                DateTimePicker::make('start_date'),
                                DateTimePicker::make('end_date'),
                                Select::make('created_by')
                                    ->relationship('creator', 'name')
                                    ->required()
                                    ->default(Auth::user()->id)
                                    ->disabled()
                                    ->dehydrated(true)
                                    ->searchable()
                                    ->preload(),
                                Select::make('updated_by')
                                    ->relationship('updater', 'name')
                                    ->required()
                                    ->default(Auth::user()->id)
                                    ->disabled()
                                    ->dehydrated(true)
                                    ->preload()
                                    ->searchable(),
                            ])->columns(2)
                    ])
                    ->columnSpan(2),

                Group::make()
                    ->schema([
                        Section::make('Project Image')
                            ->schema([
                                FileUpload::make('image_path')
                                    ->image()
                                    ->label('Image')
                                    ->disk('public')
                                    ->downloadable()
                                    ->preserveFilenames()
                                    ->openable(),
                            ]),

                        Section::make('Associations')
                            ->schema([
                                Select::make('category_id')
                                    ->relationship('category', 'name', function ($query) {
                                        $query->where('type', CategoryType::Project);
                                    })
                                    ->placeholder('Select category')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                Select::make('status')
                                    ->options([
                                        'Pending' => 'Pending',
                                        'On hold' => 'On hold',
                                        'In progress' => 'In progress',
                                        'Completed' => 'Completed',
                                        'Cancelled' => 'Cancelled',
                                    ])
                                    ->default('Pending')
                                    ->required(),
                            ])

                    ]),

            ])
            ->columns(3);
    }
}
