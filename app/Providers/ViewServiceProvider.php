<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\MenuService;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(MenuService $menuService): void
    {
        View::composer(
            [
                'partials.header',
                'partials.footer',
                'home',
            ],
            function ($view) use ($menuService) {
                $view->with([
                    'developers' => $menuService->developers(),
                ]);
            }
        );

        View::composer('partials.property-search', function ($view) use ($menuService) {
            $view->with($menuService->propertySearch());
        });
    }
}
