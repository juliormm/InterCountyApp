<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            '*', 'App\Http\ViewComposers\CampaignComposer'
        );

        // View::composer(
        //     'campaign.campaign-status', 'App\Http\ViewComposers\CampaignComposer'
        // );

        // // Using Closure based composers...
        // View::composer('dashboard', function ($view) {
        //     //
        // });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
