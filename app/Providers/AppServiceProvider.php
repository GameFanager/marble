<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Support\ServiceProvider;
use App\TreeHelper;
use App\NodeHelper;
use Config;

class AppServiceProvider extends ServiceProvider
{
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
/*
        $nodeTree = TreeHelper::generate();
        view()->share('nodeTree', $nodeTree);

        $node = NodeHelper::getSystemNode("settings");

        view()->share('locale_id', Config::get('app.locale_id'));*/
    }

    public function register()
    {
        //
    }
}
