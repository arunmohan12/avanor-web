<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Project')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('developer.name')
                    ->label('Developer')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('emirate.name')
                    ->label('Emirate')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('community.name')
                    ->label('Community')
                    ->default('—')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status')
                    ->badge(),

                TextColumn::make('handover')
                    ->label('Handover')
                    ->state(fn ($record) => $record->handover_quarter && $record->handover_year
                        ? "{$record->handover_quarter} {$record->handover_year}"
                        : '—'),

                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                // TextColumn::make('display_order')
                //     ->label('Order')
                //     ->sortable(),
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
