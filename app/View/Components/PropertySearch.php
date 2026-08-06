<?php

namespace App\View\Components;

use App\Services\MenuService;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PropertySearch extends Component
{
    public array $propertyTypes;
    public array $communities;
    public array $developers;
    public array $bedrooms;
    public array $priceRanges;

    public function __construct(MenuService $menuService)
    {
        $data = $menuService->propertySearch();

        $this->propertyTypes = $data['propertyTypes'];
        $this->communities = $data['communities'];
        $this->developers = $data['developers'];
        $this->bedrooms = $data['bedrooms'];
        $this->priceRanges = $data['priceRanges'];
    }

    public function render(): View
    {
        return view('components.property-search');
    }
}