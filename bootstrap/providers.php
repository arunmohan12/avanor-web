<?php

use App\Providers\AppServiceProvider;
use App\Providers\Filament\AdminPanelProvider;
use App\Providers\Filament\LeadsPanelProvider;
use App\Providers\ViewServiceProvider;

return [
    AppServiceProvider::class,
    AdminPanelProvider::class,
    LeadsPanelProvider::class,
    ViewServiceProvider::class,
];
