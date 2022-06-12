<?php

namespace MalvikLab\Laravel\MiddlewareToolbox\Providers;

use Illuminate\Support\ServiceProvider;
use MalvikLab\Laravel\MiddlewareToolbox\Http\Middleware\ToolboxMiddleware;

class MiddlewareToolboxServiceProvider extends ServiceProvider
{
    private const VERSION = '1.0.0';
    private string $packageTag = 'malviklab-laravel-middleware-toolbox';

    public function boot(): void
    {
        $configFileName = sprintf('%s.php', $this->packageTag);

        $this->publishes([
            sprintf('%s/../../config/%s', __DIR__, $configFileName) => config_path($configFileName),
        ], sprintf('%s-config', $this->packageTag));

        $router = $this->app['router'];
        $router->aliasMiddleware('malviklab-laravel-middleware-toolbox', ToolboxMiddleware::class);
    }

    public function register(): void
    {
    }
}
