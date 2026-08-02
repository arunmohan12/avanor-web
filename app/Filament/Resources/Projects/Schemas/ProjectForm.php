<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Enums\ProjectStatus;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Schemas\Components\Utilities\Get;

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
                            ->relationship('developer', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

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

                Section::make('Location')
                    ->columns(1)
                    ->schema([

                        Select::make('emirate_id')
                            ->relationship('emirate', 'name')
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (Set $set) {
                                $set('community_id', null);
                            }),

                        Select::make('community_id')
                            ->label('Community')
                            ->options(function (Get $get) {

                                $emirateId = $get('emirate_id');

                                if (!$emirateId) {
                                    return [];
                                }

                                return \App\Models\Community::where('emirate_id', $emirateId)
                                    ->pluck('name', 'id');
                            })
                            ->searchable()
                            ->nullable()
                            ->placeholder('Select community (optional)'),

                        TextInput::make('map_url')
                            ->label('Google Maps URL')
                            ->url(),

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
                    ->columns(1)
                    ->schema([

                        FileUpload::make('thumbnail')
                            ->image()
                            ->imageEditor()
                            ->directory('projects/thumbnails'),

                        FileUpload::make('cover_image')
                            ->image()
                            ->imageEditor()
                            ->directory('projects/covers'),

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
