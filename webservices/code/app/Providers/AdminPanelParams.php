<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AdminPanelParams extends ServiceProvider
{

    public function boot()
    {
        View::share('timeNow',(new \Moment\Moment('@'.time(), 'CET'))->subtractDays(env("profitDay"))->format('Y-m-d'));
    }

    public function register()
    {

    }
}
