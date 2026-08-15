<?php

namespace App\Filament\Leads\Resources\Leads\Pages;

use App\Filament\Leads\Resources\Leads\LeadResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLead extends CreateRecord
{
    protected static string $resource = LeadResource::class;
}
