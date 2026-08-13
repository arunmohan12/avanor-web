<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    protected static ?string $title = 'Gallery Images';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([



                Toggle::make('is_featured')
                    ->label('Featured / Hero Image')
                    ->helperText('Featured image will appear first in the property hero gallery.')
                    ->default(false),

                TextInput::make('display_order')
                    ->label('Display Order')
                    ->numeric()
                    ->default(0)
                    ->minValue(0),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->defaultSort('display_order')
            ->columns([

                ImageColumn::make('image')
                    ->label('Preview')
                    ->disk('s3')
                    ->visibility('private')
                    ->square(),

                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),

                TextColumn::make('display_order')
                    ->label('Order')
                    ->sortable(),

            ])
            ->headerActions([
                \Filament\Actions\CreateAction::make()
                    ->label('Add Gallery Image'),
            ])
            ->recordActions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ]);
    }
}