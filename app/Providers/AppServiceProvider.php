<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Node;
use App\TreeHelper;
use Config;

class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        
        $nodeTree = TreeHelper::generate();
        view()->share('nodeTree', $nodeTree);

        view()->share('locale_id', Config::get('app.locale_id'));
    }

    public function register()
    {
        //
    }
}
