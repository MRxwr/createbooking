<?php

namespace Sbhadra\Packagetypes\Providers;

use Juzaweb\Support\ServiceProvider;
use Sbhadra\Packagetypes\Actions\MainAction;
use Illuminate\Support\Facades\Schema;

class PackageTypesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerAction([
            MainAction::class
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
