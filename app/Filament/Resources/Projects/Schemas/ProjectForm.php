<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Enums\ProjectStatus;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

                Section::make('General Information')
                    ->columns(1)
                    ->schema([

                        Select::make('developer_id')
    ->label('Developer')
    ->relationship('developer', 'name')
    ->searchable()
    ->preload()
    ->required(),

Select::make('emirate_id')
    ->label('Emirate')
    ->relationship('emirate', 'name')
    ->searchable()
    ->preload()
    ->required()
    ->live()
    ->afterStateUpdated(function (Set $set) {
        $set('community_id', null);
        $set('location', null);
    }),

Select::make('community_id')
    ->label('Community')
    ->options(function (Get $get) {

        $emirateId = $get('emirate_id');

        if (! $emirateId) {
            return [];
        }

        return \App\Models\Community::query()
            ->where('emirate_id', $emirateId)
            ->where('is_active', true)
            ->orderBy('name')
            ->pluck('name', 'id');
    })
    ->searchable()
    ->nullable()
    ->live()
    ->placeholder('Select community (optional)')
    ->afterStateUpdated(function ($state, Set $set) {

        if (! $state) {
            $set('location', null);
            return;
        }

        $community = \App\Models\Community::find($state);

        if (filled($community?->area)) {
            $set('location', $community->area);
        } else {
            $set('location', null);
        }
    }),

TextInput::make('location')
    ->label('Location')
    ->maxLength(255)
    ->disabled(function (Get $get) {

        $communityId = $get('community_id');

        if (! $communityId) {
            return false;
        }

        $community = \App\Models\Community::find($communityId);

        return filled($community?->area);
    })
    ->dehydrated(),
                    
                

                        TextInput::make('map_url')
                            ->label('Google Maps URL')
                            ->url(),

                        TextInput::make('name')
                            ->label('Project Name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (?string $state, Set $set) {
                                if ($state) {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        TextInput::make('slug')
                            ->required(),

                        Select::make('status')
                            ->options(ProjectStatus::options())
                            ->required(),

                    ]),


                Section::make('Pricing')
                    ->schema([

                        TextInput::make('starting_price')
                            ->numeric()
                            ->prefix('AED'),

                        Select::make('handover_quarter')
                            ->options([
                                'Q1' => 'Q1',
                                'Q2' => 'Q2',
                                'Q3' => 'Q3',
                                'Q4' => 'Q4',
                            ])
                            ->placeholder('Select Quarter'),

                        Select::make('handover_year')
                            ->options(
                                collect(range(now()->year, now()->year + 10))
                                    ->mapWithKeys(fn($year) => [$year => $year])
                                    ->toArray()
                            )
                            ->searchable()
                            ->placeholder('Select Year'),

                    ]),

                Section::make('Media')
                    ->columns(2)
                    ->schema([

                        SpatieMediaLibraryFileUpload::make('thumbnail')
                            ->label('Thumbnail')
                            ->collection('thumbnail')
                            ->image()
                            ->imageEditor()
                            ->maxSize(4096),

                        SpatieMediaLibraryFileUpload::make('cover')
                            ->label('Cover Image')
                            ->collection('cover')
                            ->image()
                            ->imageEditor()
                            ->maxSize(6144),

                    ]),

                Section::make('Description')
                    ->columns(1)
                    ->schema([

                        Textarea::make('short_description')
                            ->rows(3),

                        Textarea::make('description')
                            ->rows(8),

                    ]),

                Section::make('SEO')
                    ->columns(1)
                    ->schema([

                        TextInput::make('meta_title'),

                        Textarea::make('meta_description')
                            ->rows(3),

                        TextInput::make('meta_keywords'),

                    ]),

                Section::make('Settings')
                    ->columns(1)
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
