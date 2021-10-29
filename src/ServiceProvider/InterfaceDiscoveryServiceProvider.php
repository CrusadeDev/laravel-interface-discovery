<?php

declare(strict_types=1);

namespace Crusade\LaravelInterface\ServiceProvider;

use Crusade\LaravelInterface\ArrayList;
use Crusade\LaravelInterface\Console\IndexAllCommand;
use Crusade\LaravelInterface\Port\ConfigLaravelPath;
use Crusade\LaravelInterface\Port\ConfigPathInterface;
use Illuminate\Cache\Repository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

final class InterfaceDiscoveryServiceProvider extends ServiceProvider
{
    /**
     * @throws BindingResolutionException
     */
    public function register(): void
    {
        $this->app->bind(ConfigPathInterface::class, ConfigLaravelPath::class);

        /** @var Repository $config * */
        $config = $this->app->make('config');
        $list = ArrayList::wrap($config->get('generated_config'));

        $list->each(function (string $interface, string $key): void {
            $this->app->bind($key, $interface);
        });

        $this->commands([IndexAllCommand::class]);
    }
}
