<?php

namespace Sbhadra\Packagethemes\Providers;

use Juzaweb\Support\ServiceProvider;
use Sbhadra\Packagethemes\Actions\MainAction;
use Illuminate\Support\Facades\Schema;


class PackageThemesServiceProvider extends ServiceProvider
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
