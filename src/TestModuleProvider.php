<?php
namespace Anavel\Test;

use Anavel\Foundation\Support\ModuleProvider;
use Request;
use Schema;

class TestModuleProvider extends ModuleProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../views', 'anavel-test');
        $this->publishes([
            __DIR__.'/../config/anavel-test.php' => config_path('anavel-test.php'),
        ], 'config');

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/anavel-test.php', 'anavel-test');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    public function name()
    {
        return config('anavel-test.name');
    }

    public function routes()
    {
        return __DIR__.'/Http/routes.php';
    }

    public function mainRoute()
    {
        return route('anavel-test.home');
    }

    public function hasSidebar()
    {
        return false;
    }

    public function sidebarMenu()
    {
        return null;
    }

    public function isActive()
    {
        $uri = Request::route()->uri();

        if (strpos($uri, 'test') !== false) {
            return true;
        }

        return false;
    }

}
