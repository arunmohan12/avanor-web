<?php

namespace App\Filament\Resources\Amenities\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AmenityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Amenity Details')
                    ->columns(2)
                    ->schema([

                        TextInput::make('name')
                            ->label('Amenity Name')
                            ->placeholder('Swimming Pool')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('icon')
                            ->label('Icon Class')
                            ->placeholder('fa-solid fa-person-swimming')
                            ->helperText('Optional Font Awesome icon class.'),

                        TextInput::make('display_order')
                            ->label('Display Order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),

                    ]),

            ]);
    }
}