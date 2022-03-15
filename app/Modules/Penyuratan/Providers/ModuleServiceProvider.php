<?php

namespace App\Modules\Penyuratan\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(module_path('penyuratan', 'Resources/Lang', 'app'), 'penyuratan');
        $this->loadViewsFrom(module_path('penyuratan', 'Resources/Views', 'app'), 'penyuratan');
        $this->loadMigrationsFrom(module_path('penyuratan', 'Database/Migrations', 'app'));
        if(!$this->app->configurationIsCached()) {
            $this->loadConfigsFrom(module_path('penyuratan', 'Config', 'app'));
        }
        $this->loadFactoriesFrom(module_path('penyuratan', 'Database/Factories', 'app'));
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
