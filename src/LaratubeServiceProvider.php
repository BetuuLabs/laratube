<?php 


namespace Betuulabs\Laratube;

use Illuminate\Support\ServiceProvider;

class LaratubeServiceProvider extends ServiceProvider
{


	protected $config;


	public function boot()
	{ 

		// get config path
		this->config = realpath(__DIR__.'/../config/laratube.php');


		//Default Package Configuration
		$this->mergeConfigFrom($config, 'laratube');

		// get route config

		if($this->app->config->get('youtube.routes.enabled')) {
            include __DIR__.'/../routes/web.php';
        }



		$this->publishes([$this->config => config_path('laratube.php')], 'config');
		$this->publishes([
            __DIR__.'/../migrations/' => database_path('migrations')
        ], 'migrations');
	}


	/**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('youtube', function($app) {
            return new Laratube($app, new \Google_Client);
        });
    }


}