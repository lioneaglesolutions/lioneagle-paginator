<?php

namespace Lioneagle\LioneaglePaginator;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
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
        collect([Builder::class, HasManyThrough::class, BelongsTo::class])->each(function ($builder) {
            $builder::macro('paginator', function ($perPage = null, $columns = ['*'], $pageName = 'page', $page = null) {
                $pageSizeParam = config('lioneagle-paginator.page_size.url_parameter');
                $pageNumberParam = config('lioneagle-paginator.page_number.url_parameter');

                $defaultPageSize = config('lioneagle-paginator.page_size.default');
                $defaultPageNumber = config('lioneagle-paginator.page_number.default');

                /** @var \Illuminate\Database\Eloquent\Builder $this */
                $pageSize = $perPage ?? (int) request()->input("page.{$pageSizeParam}", $defaultPageSize);
                $pageNumber = $page ?? (int) request()->input("page.{$pageNumberParam}", $defaultPageNumber);

                return $this->paginate($pageSize, $columns, $pageName, $pageNumber);
            });
        });
    }
}
