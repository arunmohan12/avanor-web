<?php

namespace App\Filament\Resources\Properties\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Models\Community;
use App\Models\Project;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;

class PropertyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

                Section::make('1. Hero & Gallery')
                    ->description('Manage the images used in the main property hero slider and gallery.')
                    ->schema([


                        SpatieMediaLibraryFileUpload::make('thumbnail')
                            ->label('Thumbnail')
                            ->collection('thumbnail')
                            ->disk('s3')
                            ->visibility('private')
                            ->image()
                            ->imageEditor()
                            ->maxSize(4096),

                        SpatieMediaLibraryFileUpload::make('cover')
                            ->label('Primary Cover Image')
                            ->collection('cover')
                            ->disk('s3')
                            ->visibility('private')
                            ->image()
                            ->imageEditor()
                            ->maxSize(6144),

                        SpatieMediaLibraryFileUpload::make('gallery')
                            ->label('Gallery Images')
                            ->collection('gallery')
                            ->multiple()
                            ->reorderable()
                            ->image()
                            ->imageEditor()
                            ->maxFiles(20)
                            ->maxSize(8192)
                            ->columnSpanFull(),

                    ]),

                    Section::make('2. Property Overview')
                    ->description('Main property information shown directly below the hero gallery.')
                    ->columns(2)
                    ->schema([
                
                        TextInput::make('title')
                            ->label('Property Title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (?string $state, Set $set) {
                                $set('slug', Str::slug($state));
                            })
                            ->columnSpanFull(),
                
                        TextInput::make('slug')
                            ->disabled()
                            ->dehydrated()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->columnSpanFull(),
                
                        Select::make('project_id')
                            ->label('Project')
                            ->options(
                                Project::query()
                                    ->where('is_active', true)
                                    ->orderBy('name')
                                    ->pluck('name', 'id')
                            )
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->live()
                            ->placeholder('Select Project (Optional)')
                            ->columnSpanFull()
                            ->afterStateUpdated(function ($state, Set $set) {
                
                                if (! $state) {
                                    $set('unitTypes', []);
                                    return;
                                }
                
                                $project = Project::query()
                                    ->with('unitTypes')
                                    ->find($state);
                
                                if (! $project) {
                                    return;
                                }
                
                                $set('developer_id', $project->developer_id);
                                $set('emirate_id', $project->emirate_id);
                                $set('community_id', $project->community_id);
                
                                $set('starting_price', $project->starting_price);
                                $set('handover_quarter', $project->handover_quarter);
                                $set('handover_year', $project->handover_year);
                                $set('payment_plan', $project->payment_plan);
                
                                $set(
                                    'unitTypes',
                                    $project->unitTypes
                                        ->map(fn ($unitType) => [
                                            'property_type_id' => $unitType->property_type_id,
                                            'bedrooms_from' => $unitType->bedrooms_from,
                                            'bedrooms_to' => $unitType->bedrooms_to,
                                            'display_order' => $unitType->display_order,
                                        ])
                                        ->values()
                                        ->toArray()
                                );
                            }),
                
                        Select::make('developer_id')
                            ->label('Developer')
                            ->relationship('developer', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->disabled(fn (Get $get) => filled($get('project_id')))
                            ->dehydrated(),
                
                        Select::make('emirate_id')
                            ->label('Emirate')
                            ->relationship('emirate', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live()
                            ->disabled(fn (Get $get) => filled($get('project_id')))
                            ->dehydrated()
                            ->afterStateUpdated(function (Set $set, Get $get) {
                                if (! $get('project_id')) {
                                    $set('community_id', null);
                                }
                            }),
                
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
                            ->placeholder('Select Community (Optional)')
                            ->disabled(fn (Get $get) => filled($get('project_id')))
                            ->dehydrated(),
                
                        // Select::make('property_type_id')
                        //     ->label('Property Type')
                        //     ->relationship('propertyType', 'name')
                        //     ->searchable()
                        //     ->preload()
                        //     ->required(),
                
                        RichEditor::make('description')
                            ->label('Property Description')
                            ->columnSpanFull(),
                
                    ]),

                Section::make('3. Property Facts')
                    ->description('Project values are loaded automatically and can be changed for this property.')
                    ->columns(3)
                    ->schema([

                        TextInput::make('price')
                            ->label('Property Price')
                            ->numeric()
                            ->prefix('AED')
                            ->minValue(0),

                            TextInput::make('starting_price')
                            ->label('Starting Price')
                            ->numeric()
                            ->prefix('AED')
                            ->afterStateHydrated(function ($state, Set $set, Get $get) {
                        
                                // Property already has its own price.
                                if (filled($state)) {
                                    return;
                                }
                        
                                $projectId = $get('project_id');
                        
                                if (! $projectId) {
                                    return;
                                }
                        
                                $project = Project::find($projectId);
                        
                                if (filled($project?->starting_price)) {
                                    $set('starting_price', $project->starting_price);
                                }
                            })
                            ->disabled(function (Get $get) {
                        
                                $projectId = $get('project_id');
                        
                                if (! $projectId) {
                                    return false;
                                }
                        
                                // Disable only when project itself has a price.
                                return filled(
                                    Project::find($projectId)?->starting_price
                                );
                            })
                            ->dehydrated(false),

                        // TextInput::make('bedrooms')
                        //     ->label('Bedrooms')
                        //     ->numeric()
                        //     ->minValue(0),

                        // TextInput::make('bathrooms')
                        //     ->label('Bathrooms')
                        //     ->numeric()
                        //     ->minValue(0),

                        Select::make('handover_quarter')
                        ->label('Handover Quarter')
                        ->options([
                            'Q1' => 'Q1',
                            'Q2' => 'Q2',
                            'Q3' => 'Q3',
                            'Q4' => 'Q4',
                        ])
                        ->afterStateHydrated(function ($state, Set $set, $record) {
                    
                            // Property already has its own value
                            if (filled($state)) {
                                return;
                            }
                    
                            // Editing existing property: take from project
                            if ($record?->project && filled($record->project->handover_quarter)) {
                                $set(
                                    'handover_quarter',
                                    $record->project->handover_quarter
                                );
                            }
                        })
                        ->disabled(function (Get $get) {
                    
                            $projectId = $get('project_id');
                    
                            if (! $projectId) {
                                return false;
                            }
                    
                            return filled(
                                Project::find($projectId)?->handover_quarter
                            );
                        })
                        ->dehydrated(),

                        TextInput::make('handover_year')
                        ->label('Handover Year')
                        ->numeric()
                        ->afterStateHydrated(function ($state, Set $set, $record) {
                    
                            // Property already has its own value
                            if (filled($state)) {
                                return;
                            }
                    
                            // Editing existing property: take from project
                            if ($record?->project && filled($record->project->handover_year)) {
                                $set(
                                    'handover_year',
                                    $record->project->handover_year
                                );
                            }
                        })
                        ->disabled(function (Get $get) {
                    
                            $projectId = $get('project_id');
                    
                            if (! $projectId) {
                                return false;
                            }
                    
                            return filled(
                                Project::find($projectId)?->handover_year
                            );
                        })
                        ->dehydrated(),

                        TextInput::make('payment_plan')
                            ->label('Payment Plan')
                            ->placeholder('80/20')
                            ->helperText('Loaded from the selected project. You can change or clear it.'),

                        Repeater::make('unitTypes')
                            ->label('Unit Types')
                            ->relationship()
                            ->schema([

                                Select::make('property_type_id')
                                    ->label('Property Type')
                                    ->relationship('propertyType', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                TextInput::make('bedrooms_from')
                                    ->label('From BR')
                                    ->numeric()
                                    ->minValue(0)
                                    ->nullable(),

                                TextInput::make('bedrooms_to')
                                    ->label('To BR')
                                    ->numeric()
                                    ->minValue(0)
                                    ->nullable(),

                                TextInput::make('display_order')
                                    ->label('Order')
                                    ->numeric()
                                    ->default(0),

                            ])
                            ->columns(4)
                            ->defaultItems(0)
                            ->addActionLabel('Add Unit Type')
                            ->reorderable('display_order')
                            ->columnSpanFull(),

                    ]),

                

                Section::make('4. Amenities')
                    ->description('Select the amenities and features available for this property.')
                    ->schema([

                        Select::make('amenities')
                            ->label('Property Amenities')
                            ->relationship(
                                name: 'amenities',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn($query) => $query
                                    ->where('is_active', true)
                                    ->orderBy('display_order')
                                    ->orderBy('name')
                            )
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->placeholder('Select Amenities')
                            ->columnSpanFull(),

                    ]),

                Section::make('5. Location')
                    ->description('Location details shown in the property location section.')
                    ->columns(2)
                    ->schema([

                        TextInput::make('map_url')
                            ->label('Google Maps Embed URL')
                            ->url()
                            ->placeholder('https://www.google.com/maps/embed?...')
                            ->helperText('Use the Google Maps embed URL, not the normal share link.')
                            ->columnSpanFull(),

                    ]),

                Section::make('6. SEO')
                    ->description('Search engine metadata for this property page.')
                    ->schema([

                        TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->maxLength(60)
                            ->helperText('Recommended: up to 60 characters.')
                            ->columnSpanFull(),

                        Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->rows(3)
                            ->maxLength(160)
                            ->helperText('Recommended: up to 160 characters.')
                            ->columnSpanFull(),

                        TextInput::make('meta_keywords')
                            ->label('Meta Keywords')
                            ->placeholder('dubai property, villa, apartment')
                            ->columnSpanFull(),

                    ]),

                Section::make('7. Settings')
                    ->description('Control visibility and ordering of this property.')
                    ->columns(3)
                    ->schema([

                        Toggle::make('is_featured')
                            ->label('Featured Property')
                            ->helperText('Show this property in featured property sections.')
                            ->default(false),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->helperText('Disable this to hide the property from the website.')
                            ->default(true),

                        TextInput::make('display_order')
                            ->label('Display Order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->helperText('Lower numbers appear first.'),

                    ]),

            ]);
    }
}
