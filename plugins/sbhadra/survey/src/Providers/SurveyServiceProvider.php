<?php

namespace Sbhadra\Survey\Providers;

use Juzaweb\Support\ServiceProvider;
use Sbhadra\Survey\Actions\MainAction;
use Illuminate\Support\Facades\Schema;

class SurveyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Schema::defaultStringLength(191);
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
