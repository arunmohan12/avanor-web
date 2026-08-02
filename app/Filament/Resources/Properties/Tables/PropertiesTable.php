<?php

namespace App\Filament\Resources\Properties\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Support\PriceFormatter;

class PropertiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('developer.name')
                    ->label('Developer')
                    ->searchable()
                    ->sortable(),
                    TextColumn::make('project.name')
                    ->label('Project')
                    ->searchable()
                    ->sortable(),
             
                    TextColumn::make('community.name')
                    ->label('Community')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('title')
                    ->searchable(),

             
             

                TextColumn::make('price')
                    ->label('Price')
                    ->formatStateUsing(fn($state) => PriceFormatter::aed($state))
                    ->sortable(),

                IconColumn::make('is_featured')
                    ->boolean(),
                IconColumn::make('is_active')
                    ->boolean(),


            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
