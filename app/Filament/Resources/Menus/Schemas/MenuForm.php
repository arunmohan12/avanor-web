<?php

namespace App\Filament\Resources\Menus\Schemas;

use App\Models\Menu;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Menu Information')
                    ->schema([

                        TextInput::make('label')
                            ->label('Menu Label')
                            ->required()
                            ->maxLength(100)
                            ->columnSpanFull(),

                        Select::make('parent_id')
                            ->label('Parent Menu')
                            ->options(
                                Menu::query()
                                    ->orderBy('display_order')
                                    ->orderBy('label')
                                    ->pluck('label', 'id')
                            )
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->helperText('Leave empty for a main menu item.')
                            ->columnSpanFull(),

                        TextInput::make('route_name')
                            ->label('Route Name')
                            ->placeholder('properties.index')
                            ->helperText('Use a Laravel route name when available.')
                            ->columnSpanFull(),

                        TextInput::make('url')
                            ->label('Custom URL')
                            ->placeholder('https://example.com or /contact')
                            ->helperText('Use only when no Laravel route name is available.')
                            ->columnSpanFull(),

                    ]),

                Section::make('Display Settings')
                    ->schema([

                        TextInput::make('display_order')
                            ->label('Display Order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->required()
                            ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->columnSpanFull(),

                    ]),

            ]);
    }
}