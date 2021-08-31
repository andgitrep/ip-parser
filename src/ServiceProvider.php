<?php

namespace Gruzdev\IpParser;


use GeoIp2\Database\Reader;
use GeoIp2\ProviderInterface;
use Gruzdev\IpParser\Adapters\MaxMindAdapter;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(MaxMindAdapter::class)
            ->needs(ProviderInterface::class)
            ->give(function () {
                return new Reader(resource_path(config('ipparser.path', 'maxmind/GeoLite2-City.mmdb') ));
            });
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/ipparser.php';
        $this->publishes([$configPath => $this->getConfigPath()], 'config');
    }

    /**
     * Get the config path
     *
     * @return string
     */
    protected function getConfigPath()
    {
        return config_path('ipparser.php');
    }

    /**
     * Publish the config file
     *
     * @param  string $configPath
     */
    protected function publishConfig($configPath)
    {
        $this->publishes([$configPath => config_path('ipparser.php')], 'config');
    }

}
