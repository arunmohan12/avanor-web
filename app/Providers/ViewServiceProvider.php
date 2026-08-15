<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\MenuService;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

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
                'about',
                'contact',
                'developers.partners'
            ],
            function ($view) use ($menuService) {
                $view->with([
                    'developers' => $menuService->developers(),
                    'navigation' => $menuService->navigation(),
                ]);
            }
        );

        View::composer('partials.property-search', function ($view) use ($menuService) {
            $view->with($menuService->propertySearch());
        });


        View::composer('*', function ($view) {

            $siteSettings = Cache::remember(
                'site_settings',
                now()->addHours(12),
                fn () => SiteSetting::query()
                    ->first()
                    ?->toArray()
            );
        
            $view->with('siteSettings', $siteSettings);
        });
    }
}
