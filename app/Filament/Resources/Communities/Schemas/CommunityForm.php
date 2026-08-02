<?php

namespace App\Filament\Resources\Communities\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

class CommunityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
    ->components([
        Select::make('emirate_id')
            ->relationship('emirate', 'name')
            ->searchable()
            ->preload()
            ->required(),

        TextInput::make('name')
            ->required()
            ->live()
            ->afterStateUpdated(function ($state, Set $set) {
                $set('slug', Str::slug($state));
            }),

        TextInput::make('slug')
            ->required()
            ->disabled()
            ->dehydrated()
            ->unique(ignoreRecord: true),

        TextInput::make('area')
            ->nullable(),

        Toggle::make('is_active')
            ->default(true),
    ]);
    }
}
