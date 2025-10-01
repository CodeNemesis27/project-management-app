<?php

namespace App\Filament\Resources\Tasks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class TaskForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Task details')
                            ->schema([
                                TextInput::make('name')
                                    ->placeholder('Enter task name')
                                    ->required(),
                                DatePicker::make('due_date'),
                                Textarea::make('description')
                                    ->columnSpanFull()
                                    ->placeholder('Enter task description'),
                                Select::make('priority')
                                    ->options(['Low' => 'Low', 'Medium' => 'Medium', 'High' => 'High'])
                                    ->default('Low')
                                    ->required(),
                                Select::make('assigned_user_id')
                                    ->placeholder('Select user')
                                    ->relationship('assigned_user', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->default(null),
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
                    ])->columnSpan(2),

                Group::make()
                    ->schema([
                        Section::make('Task image')
                            ->schema([
                                FileUpload::make('image_path')
                                    ->disk('public')
                                    ->label('Image')
                                    ->downloadable()
                                    ->preserveFilenames()
                                    ->openable()
                                    ->directory('tasks')
                                    ->image(),
                            ]),

                        Section::make('Associations')
                            ->schema([
                                Select::make('category_id')
                                    ->placeholder('Select category')
                                    ->relationship('category', 'name')
                                    ->required(),
                                Select::make('project_id')
                                    ->required()
                                    ->placeholder('Select project')
                                    ->searchable()
                                    ->preload()
                                    ->relationship('project', 'name'),
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
