<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
		view()->composer('partials.header', function($view)
        {
            $view->with('layout', \App\Models\Layout::all());
        });

        view()->composer('partials.header', function($view)
        {
            $view->with('menu', \App\Models\EntityMenu::all());
        });

        view()->composer('partials.footer', function($view)
        {
            $view->with('layout', \App\Models\Layout::all());
        });

        view()->composer('layouts.app', function($view)
        {
            $view->with('api', \App\Models\Api::all());
        });

	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}

}
