<?php

namespace App\Filament\Resources\Communities\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CommunityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

                Section::make('General Information')
                    ->schema([

                        Select::make('emirate_id')
                            ->label('Emirate')
                            ->relationship('emirate', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('name')
                            ->label('Community Name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (?string $state, Set $set) {
                                if (filled($state)) {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        TextInput::make('slug')
                            ->disabled()
                            ->dehydrated()
                            ->required()
                            ->unique(ignoreRecord: true),

                        TextInput::make('area')
                            ->label('Area')
                            ->maxLength(255),

                    ])
                    ->columns(2),

                Section::make('Images')
                    ->schema([

                        FileUpload::make('thumbnail')
                            ->label('Thumbnail')
                            ->image()
                            ->disk('public')
                            ->directory('communities/thumbnails')
                            ->visibility('public')
                            ->imageEditor(),

                        FileUpload::make('hero')
                            ->label('Hero Image')
                            ->image()
                            ->disk('public')
                            ->directory('communities/heroes')
                            ->visibility('public')
                            ->imageEditor(),

                    ])
                    ->columns(2),

                Section::make('Status')
                    ->schema([

                        Toggle::make('is_featured')
                            ->label('Featured')
                            ->default(false),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),

                    ])
                    ->columns(2),

            ]);
    }
}
