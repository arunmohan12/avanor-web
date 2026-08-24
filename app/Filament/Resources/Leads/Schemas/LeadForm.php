<?php

namespace App\Filament\Resources\Leads\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LeadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

                Section::make('Lead Information')
                    ->schema([

                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(30),

                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->maxLength(255),

                        Select::make('property_id')
                            ->label('Property')
                            ->relationship('property', 'title')
                            ->searchable()
                            ->preload()
                            ->nullable(),

                        Select::make('developer_id')
                            ->label('Developer')
                            ->relationship('developer', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),

                    ])
                    ->columns(2),

                Section::make('Source Information')
                    ->schema([

                        TextInput::make('source')
                            ->maxLength(255),

                        TextInput::make('page_url')
                            ->label('Page URL')
                            ->url()
                            ->maxLength(255),

                    ])
                    ->columns(2),

                Section::make('Marketing Tracking')
                    ->schema([

                        TextInput::make('utm_source')
                            ->label('UTM Source')
                            ->maxLength(255),

                        TextInput::make('utm_medium')
                            ->label('UTM Medium')
                            ->maxLength(255),

                        TextInput::make('utm_campaign')
                            ->label('UTM Campaign')
                            ->maxLength(255),

                        TextInput::make('utm_content')
                            ->label('UTM Content')
                            ->maxLength(255),

                        TextInput::make('utm_term')
                            ->label('UTM Term')
                            ->maxLength(255),

                        TextInput::make('gclid')
                            ->label('Google Click ID')
                            ->maxLength(255),

                        TextInput::make('fbclid')
                            ->label('Facebook Click ID')
                            ->maxLength(255),

                    ])
                    ->columns(2)
                    ->collapsed(),

            ]);
    }
}
