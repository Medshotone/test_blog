<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Jenssegers\Agent\Agent;
use App\Browser;

class BrowserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        //get browser name
        $agent = new Agent();
        $browser_name = $agent->browser();

        //init browser model
        $browser = new Browser;

        //check if browser exist
        $new_browser =  !(bool)$browser->where('name', $browser_name)->count();

        if ($new_browser){
            //create new
            $browser->name = $browser_name;

            $browser->count = 1;
            $browser->save();
        }else{
            //update count
            $browser->where('name', $browser_name)->increment('count');
        }

    }
}
