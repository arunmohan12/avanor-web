<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SectionsRelationManager extends RelationManager
{
    protected static string $relationship = 'sections';

    protected static ?string $title = 'Property Content Sections';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('title')
                    ->label('Section Title')
                    ->placeholder('LIVING IN THE MARINA VIEWS')
                    ->columnSpanFull(),

                RichEditor::make('content')
                    ->label('Section Content')
                    ->columnSpanFull(),

                SpatieMediaLibraryFileUpload::make('section_image')
                    ->label('Section Image')
                    ->collection('section_image')
                    ->image()
                    ->imageEditor()
                    ->maxSize(6144)
                    ->columnSpanFull(),

                Select::make('layout')
                    ->label('Layout')
                    ->options([
                        'image_left' => 'Image Left / Text Right',
                        'image_right' => 'Text Left / Image Right',
                        'full_width' => 'Full Width Text',
                    ])
                    ->default('image_left')
                    ->required(),

                TextInput::make('display_order')
                    ->label('Display Order')
                    ->numeric()
                    ->default(0)
                    ->minValue(0),

                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->defaultSort('display_order')
            ->columns([

                TextColumn::make('title')
                    ->label('Title')
                    ->searchable(),

                TextColumn::make('layout')
                    ->label('Layout')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'image_left' => 'Image Left',
                        'image_right' => 'Image Right',
                        'full_width' => 'Full Width',
                        default => $state,
                    }),

                TextColumn::make('display_order')
                    ->label('Order')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Add Content Section'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
