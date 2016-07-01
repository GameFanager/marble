<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Node;
use App\TreeHelper;

class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        
        $nodeTree = TreeHelper::generate();
        view()->share('nodeTree', $nodeTree);
    }

    public function register()
    {
        //
    }
}
