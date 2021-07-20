<?php

namespace Lioneagle\LioneaglePaginator\Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Lioneagle\LioneaglePaginator\LioneaglePaginatorServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

/**
 * @internal
 * @coversNothing
 */
class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app);
        $this->setUpRoutes();
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }

    protected function getPackageProviders($app)
    {
        return [
            LioneaglePaginatorServiceProvider::class,
        ];
    }

    protected function setUpDatabase(Application $app)
    {
        // Create the table
        $app['db']->connection()->getSchemaBuilder()->create('models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Insert the models
        collect(range(1, 50))->each(function ($index) {
            Model::create([
                'name' => "Name - {$index}",
            ]);
        });
    }

    protected function setUpRoutes()
    {
        Route::get('/models', function () {
            return Model::paginator();
        });
    }
}
