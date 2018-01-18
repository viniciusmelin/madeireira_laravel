<?php

namespace App\Providers;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Container\Container;
use App\AdminLte\Events\BuildingMenu;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use App\AdminLte\AdminLteComposer;

class AdminServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Factory $view,Dispatcher $events,Repository $config)
    {

        // $this->loadViews();
        // $this->loadTranslations();
        // $this->publishConfig();

        $this->registerViewComposers($view);

        static::registerMenu($events, $config);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AdminLte::class, function (Container $app) {
            return new AdminLte(
                $app['config']['adminlte.filters'],
                $app['events'],
                $app
            );
        });
    }
    private function packagePath($path)
    {
        return __DIR__."/$path";
    }

    private function publishConfig()
    {
        $configPath = config_path().'/adminlte.php';

        // $this->publishes([
        //     $configPath => base_path('config/adminlte.php'),
        // ], 'config');


        $this->mergeConfigFrom($configPath, 'adminlte');
    }

    private function loadTranslations()
    {
        $translationsPath = $this->packagePath('resources/lang');

        $this->loadTranslationsFrom($translationsPath, 'adminlte');

        $this->publishes([
            $translationsPath => base_path('resources/lang/vendor/adminlte'),
        ], 'translations');
    }

    private function loadViews()
    {
        $viewsPath = $this->packagePath('resources/views/adminlte');

        $this->loadViewsFrom($viewsPath, 'adminlte');
    }


    private function registerViewComposers(Factory $view)
    {
       
        $view->composer('adminlte/page:page', AdminLteComposer::class);
       
    }

    public static function registerMenu(Dispatcher $events, Repository $config)
    {
       
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) use ($config) {
            $menu = $config->get('adminlte.menu');
            call_user_func_array([$event->menu, 'add'], $menu);
        });
    }
}
