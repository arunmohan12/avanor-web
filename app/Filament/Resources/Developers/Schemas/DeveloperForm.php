<?php

namespace App\Filament\Resources\Developers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class DeveloperForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
        ->columns(1)
            ->components([

                Section::make('General Information')
                ->columnSpanFull()

                    ->schema([

                        TextInput::make('name')
                            ->label('Developer Name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (?string $state, Set $set) {
                                if (filled($state)) {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        TextInput::make('slug')
                            ->required()
                            ->disabled()
                            ->dehydrated()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->helperText('Auto-generated from the developer name. You can edit it if needed.'),

                          

                        TextInput::make('website')
                            ->label('Website')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://www.example.com'),

                    ]),

                    Section::make('Media')
                    ->schema([
                
                        FileUpload::make('logo')
                            ->disk('s3')              // ← Add this
                            ->directory('developers/logos')
                            ->visibility('private')
                            ->image()
                            ->imageEditor()
                            ->maxSize(2048),
                
                        FileUpload::make('cover_image')
                            ->disk('s3')              // ← Add this
                            ->directory('developers/covers')
                            ->visibility('private')
                            ->image()
                            ->imageEditor()
                            ->maxSize(4096),
                
                    ]),
                    Section::make('Developer Description')
                    ->description('Add detailed information about the developer, communities, property types, investment highlights, and background.')
                    ->schema([
                
                        RichEditor::make('description')
                        ->label('Description')
                        ->toolbarButtons([
                            ['bold', 'italic', 'underline', 'strike', 'link'],
                            ['h2', 'h3', 'h4', 'h5','h6'],
                            ['blockquote', 'bulletList', 'orderedList'],
                            ['undo', 'redo'],
                        ])
                        ->placeholder('Write detailed information about the developer...')
                        ->columnSpanFull(),
                
                    ]),

                Section::make('SEO')
                    ->schema([

                        TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->maxLength(60)
                            ->helperText('Recommended: 50–60 characters'),

                        Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->rows(3)
                            ->maxLength(160)
                            ->helperText('Recommended: 150–160 characters'),

                        TextInput::make('meta_keywords')
                            ->label('Meta Keywords')
                            ->placeholder('luxury, dubai, developer, apartments'),

                    ]),

                Section::make('Settings')
                    ->schema([

                        Toggle::make('is_featured')
                            ->label('Featured')
                            ->default(false),

                        Toggle::make('is_active')
                            ->label('Active')
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