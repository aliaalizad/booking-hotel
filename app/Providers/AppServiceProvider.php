<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();

        // custom blade directives
        Blade::directive('canAdmin', function ($permission) {
            return "<?php if (auth('admin')->user()->can($permission)) { ?>";
        });
        Blade::directive('endcanAdmin', function () {
            return '<?php } ?>';
        });


    }
}
