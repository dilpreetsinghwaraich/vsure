<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider {

	public function register()
	{
		  $this->app->singleton('Helper_alias', function($app){
            return new \App\Classes\Helper();
        });
	}
} 