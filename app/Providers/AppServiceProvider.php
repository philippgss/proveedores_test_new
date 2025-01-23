<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Paginator::useBootstrap();
        //Paginator::defaultView('vendor.pagination.custom');
		   
		    // For Tailwind:
		    Paginator::useTailwind();
		    
		    // Override with your custom Tailwind template
    		Paginator::defaultView('vendor.pagination.custom-tailwind');
		    
		    // For Bootstrap 5:
		    //Paginator::useBootstrapFive();
		    
		    // For Semantic UI:
		    //Paginator::defaultView('pagination::semantic-ui');        
		        
        
    }
}
