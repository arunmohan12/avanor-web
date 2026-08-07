<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

class BlogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

                Section::make('General Information')
                    ->schema([

                        TextInput::make('title')
                            ->label('Blog Title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (?string $state, Set $set) {
                                if (filled($state)) {
                                    $set('slug', Str::slug($state));
                                }
                            })
                            ->columnSpanFull(),

                        TextInput::make('slug')
                            ->required()
                            ->disabled()
                            ->dehydrated()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('category')
                            ->maxLength(150)
                            ->columnSpanFull(),

                        Textarea::make('excerpt')
                            ->rows(4)
                            ->maxLength(1000)
                            ->columnSpanFull(),

                    ]),

                Section::make('Content')
                    ->schema([

                        RichEditor::make('content')
                            ->label('Blog Content')
                            ->required()
                            ->extraInputAttributes([
                                'style' => 'min-height: 400px;',
                            ])
                            ->columnSpanFull(),

                    ]),

                Section::make('Media')
                    ->schema([

                        FileUpload::make('thumbnail')
                            ->label('Thumbnail')
                            ->disk('public')
                            ->directory('blogs/thumbnails')
                            ->visibility('public')
                            ->image()
                            ->imageEditor()
                            ->maxSize(2048)
                            ->helperText('Recommended size: 600 × 400 px')
                            ->columnSpanFull(),

                        FileUpload::make('featured_image')
                            ->label('Featured Image')
                            ->disk('public')
                            ->directory('blogs/featured')
                            ->visibility('public')
                            ->image()
                            ->imageEditor()
                            ->maxSize(4096)
                            ->helperText('Recommended size: 1400 × 800 px')
                            ->columnSpanFull(),

                    ]),

                Section::make('Publishing')
                    ->schema([

                        DateTimePicker::make('published_at')
                            ->label('Published At')
                            ->default(now())
                            ->seconds(false)
                            ->required()
                            ->columnSpanFull(),

                        Toggle::make('is_featured')
                            ->label('Featured Blog')
                            ->default(false)
                            ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->columnSpanFull(),

                        TextInput::make('display_order')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->columnSpanFull(),

                    ]),

                Section::make('SEO')
                    ->schema([

                        TextInput::make('meta_title')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('meta_description')
                            ->rows(3)
                            ->maxLength(500)
                            ->columnSpanFull(),

                        Textarea::make('meta_keywords')
                            ->rows(3)
                            ->columnSpanFull(),

                    ]),

            ]);
    }
}
