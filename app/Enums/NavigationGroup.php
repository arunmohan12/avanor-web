<?php

namespace App\Enums;

enum NavigationGroup: string
{
    case PROPERTY = 'Property Management';
    case LOCATION = 'Location Management';
    case CONTENT = 'Content Management';
    case SYSTEM = 'System';
}