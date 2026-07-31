<?php

namespace App\Filament\Resources\Developers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

class DeveloperForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($state, Set $set) {
                        $set('slug', Str::slug($state));
                    }),

                TextInput::make('slug')
                    ->disabled()
                    ->dehydrated()
                    ->unique(ignoreRecord: true),
                FileUpload::make('logo')
                    ->image()
                    ->directory('developers/logos'),
                FileUpload::make('cover_image')
                    ->image()
                    ->directory('developers/covers'),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('meta_title')
                    ->default(null),
                Textarea::make('meta_description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('meta_keywords')
                    ->default(null),
                TextInput::make('website')
                    ->url()
                    ->default(null),
                Toggle::make('is_featured')
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('display_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
