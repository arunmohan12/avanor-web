<?php

namespace App\Filament\Resources\Properties\Pages;

use App\Filament\Resources\Properties\PropertyResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProperty extends EditRecord
{
    protected static string $resource = PropertyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $property = $this->record;

        if (! $property->project_id) {
            return;
        }

        $project = $property->project;

        if (! $project || $project->unitTypes()->exists()) {
            return;
        }

        foreach ($property->unitTypes as $unitType) {
            $project->unitTypes()->create([
                'property_type_id' => $unitType->property_type_id,
                'bedrooms_from' => $unitType->bedrooms_from,
                'bedrooms_to' => $unitType->bedrooms_to,
                'display_order' => $unitType->display_order,
            ]);
        }
    }
}
