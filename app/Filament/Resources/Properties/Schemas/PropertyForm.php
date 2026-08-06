<?php

namespace App\Filament\Resources\Properties\Schemas;

use App\Models\Community;
use App\Models\Project;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PropertyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
        ->columns(1)
            ->components([

                Section::make('Location & Project')
                    ->columns(2)
                    ->schema([

                        Select::make('developer_id')
                            ->label('Developer')
                            ->relationship('developer', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn (Set $set) => $set('project_id', null)),

                        Select::make('project_id')
                            ->label('Project')
                            ->options(function (Get $get) {
                                if (! $get('developer_id')) {
                                    return [];
                                }

                                return Project::query()
                                    ->where('developer_id', $get('developer_id'))
                                    ->where('is_active', true)
                                    ->orderBy('name')
                                    ->pluck('name', 'id');
                            })
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->placeholder('Select Project (Optional)'),

                        Select::make('emirate_id')
                            ->label('Emirate')
                            ->relationship('emirate', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn (Set $set) => $set('community_id', null)),

                        Select::make('community_id')
                            ->label('Community')
                            ->options(function (Get $get) {
                                if (! $get('emirate_id')) {
                                    return [];
                                }

                                return Community::query()
                                    ->where('emirate_id', $get('emirate_id'))
                                    ->where('is_active', true)
                                    ->orderBy('name')
                                    ->pluck('name', 'id');
                            })
                            ->searchable()
                            ->nullable()
                            ->placeholder('Select Community (Optional)'),

                    ]),

                Section::make('Property Details')
                    ->columns(2)
                    ->schema([

                        TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (?string $state, Set $set) {
                                $set('slug', Str::slug($state));
                            }),

                        TextInput::make('slug')
                            ->disabled()
                            ->dehydrated()
                            ->required()
                            ->unique(ignoreRecord: true),

                        Select::make('property_type_id')
                            ->label('Property Type')
                            ->relationship('propertyType', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        // Select::make('status')
                        //     ->options([
                        //         'available' => 'Available',
                        //         'reserved' => 'Reserved',
                        //         'sold' => 'Sold',
                        //     ])
                        //     ->required(),

                        TextInput::make('bedrooms')
                            ->numeric(),

                        TextInput::make('bathrooms')
                            ->numeric(),

                        TextInput::make('price')
                            ->numeric()
                            ->prefix('AED')
                            ->required(),

                    ]),

                Section::make('Images')
                    ->columns(2)
                    ->schema([

                        FileUpload::make('thumbnail')
                            ->label('Thumbnail')
                            ->image()
                            ->disk('public')
                            ->directory('properties/thumbnails')
                            ->visibility('public')
                            ->imageEditor(),
                         

                            
                        FileUpload::make('cover_image')
                        ->label('Cover')
                            ->image()
                            ->disk('public')
                            ->directory('properties/covers')
                            ->visibility('public')
                            ->imageEditor(),
                    ]),

                Section::make('Description')
                    ->schema([

                        TextInput::make('map_url')
                            ->label('Google Maps URL')
                            ->url(),

                        RichEditor::make('description')
                            ->columnSpanFull()
                            ,

                    ]),

                Section::make('SEO')
                    ->schema([

                        TextInput::make('meta_title'),

                        RichEditor::make('meta_description')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                            ]),

                        TextInput::make('meta_keywords')
                            ->placeholder('villa, dubai, palm jumeirah'),

                    ]),

                Section::make('Settings')
                    ->columns(2)
                    ->schema([

                        Toggle::make('is_featured')
                            ->default(false),

                        Toggle::make('is_active')
                            ->default(true),

                        TextInput::make('display_order')
                            ->numeric()
                            ->default(0),

                    ]),

            ]);
    }
}