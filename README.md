How to create an Anavel module
-------
**Anavel Foundation** is the backbone for an admin panel for Laravel applications. It aims to be minimalist and modular, and as a consecuence, as flexible as possible.

An Anavel module uses and extends the **Anavel Foundation** pacakge. *anavel/foundation* is the package that your module must have.

## Basic Anavel scaffold
```
moduleName/
	config -> Config files
	src -> The module sources
	views -> The module views
	tests -> The tests
	public -> The assets
	lang -> The tranlation files
```

## Step by step
- Create the module directory.
```
mkdir moduleName
cd moduleName
```

- Create the composer.json and add all the dependecies in the module directory
```
composer init --name=anavel/moduleName --author="Your name <your@email.com>" --description="The module description" -n
composer require illuminate/support:5.1.* --no-update
composer require illuminate/translation:5.1.* --no-update
composer require anavel/foundation:dev-master --no-update
composer install
```

- And set the autoload namespace.
```
 "autoload": {
    "psr-4": {
      "Anavel\\TheModuleNamespace\\": "src/"
    }
  },
```

- Create the **basic Anavel scaffold**
```
mkdir config
mkdir src
mkdir views
mkdir tests
mkdir public
mkdir lang
```
- Create  the config file `config/anavel-moduleName.php`.
```php
<?php
return ['name'=>'Module name'];
```

- Add the first route to `src/Http/routes.php`
```php
<?php
Route::group(
    [
        'prefix' => 'the-module-prefix',
        'namespace' => 'Anavel\TheModuleNamespace\Http\Controllers'
    ],
    function () {
        Route::get('/', [
            'as' => 'anavel-moduleName.home',
            'uses' => 'HomeController@index'
        ]);
    });
```

- Add the module providers to the src directory. It must extends the Foundation ModuleProvider `Anavel\Foundation\Support\ModuleProvider` and implement the abstract methods.
```php
<?php
class MyModuleProvider extends ModuleProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../views', 'anavel-moduleName');
        $this->publishes([
            __DIR__.'/../config/anavel-moduleName.php' => config_path('anavel-moduleName.php'),
        ], 'config');

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/anavel-moduleName.php', 'anavel-moduleName');
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

   /**
    * Get the module name
    *
    * @return string
    */
    public function name()
    {
        return config('anavel-moduleName.name');
    }
    
    /**
     * Return the routes file
     *
     * @return string
     */
    public function routes()
    {
        return __DIR__.'/Http/routes.php';
    }

    /**
     * Return the main route
     *     
     * @return string
     */
    public function mainRoute()
    {
        return route('anavel-test.home');
    }

    /**
     * Check if the anavel module has sidebar
     *     
     * @return boolean
     */
    public function hasSidebar()
    {
        return false;
    }

    /**
     * Get the sidebar view name
     *     
     * @return string|null
     */
    public function sidebarMenu()
    {
        return null;
    }

    /**
     * Method to check if the module is active in the main menú.
     *
     * @return boolean
     */
    public function isActive()
    {
        $uri = Request::route()->uri();

        if (strpos($uri, 'test') !== false) {
            return true;
        }

        return false;
    }

}
```

- Publish the module in *packagist*

## Install the module
In a Laravel project with `foundation` you must to:

1. Add the package to the composer file and update it
2. Publish the assets from the new module package using artisan: `php artisan vendor:publish`