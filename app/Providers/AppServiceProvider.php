<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Container\Container;
use App\AdminLte\AdminLteComposer;
use App\AdminLte\Events\BuildingMenu;

use App\AdminLte\AdminLte;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Factory $view,Dispatcher $events,Repository $config)
    {
        Schema::defaultStringLength(191);

        $this->registerViewComposers($view);
        static::registerMenu($events, $config);
    }

    /**
     * Register any application services.
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

    private function registerViewComposers(Factory $view)
    {
       
        $view->composer('adminlte/page', AdminLteComposer::class);
       
    }

    public static function registerMenu(Dispatcher $events, Repository $config)
    {
       
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) use ($config) {
            $menu = $config->get('adminlte.menu');
            call_user_func_array([$event->menu, 'add'], $menu);
        });
    }
}
