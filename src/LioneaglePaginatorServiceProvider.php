<?php

namespace Lioneagle\LioneaglePaginator;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class LioneaglePaginatorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/lioneagle-paginator.php' => config_path('lioneagle-paginator.php'),
            ], 'lioneagle-config');
        }

        $this->registerMacro();
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/lioneagle-paginator.php', 'lioneagle-paginator');
    }

    protected function registerMacro()
    {
        Builder::macro('paginator', function () {
            $pageSizeParam = config('lioneagle-paginator.page_size.url_parameter');
            $pageNumberParam = config('lioneagle-paginator.page_number.url_parameter');

            $defaultPageSize = config('lioneagle-paginator.page_size.default');
            $defaultPageNumber = config('lioneagle-paginator.page_number.default');

            /** @var \Illuminate\Database\Eloquent\Builder $this */
            $pageSize = (int) request()->input("page.{$pageSizeParam}", $defaultPageSize);
            $pageNumber = (int) request()->input("page.{$pageNumberParam}", $defaultPageNumber);

            return $this->paginate($pageSize, ['*'], 'page', $pageNumber);
        });
    }
}
