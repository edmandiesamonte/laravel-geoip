<?php

namespace Torann\GeoIP\Services;

use Torann\GeoIP\GeoIP;
use Torann\GeoIP\Location;
use Illuminate\Support\Arr;
use Torann\GeoIP\Contracts\ServiceInterface;

abstract class AbstractService implements ServiceInterface
{
    /**
     * Driver config
     *
     * @var array
     */
    protected $config;

    /**
     * Create a new service instance.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;

        $this->boot();
    }

    /**
     * The "booting" method of the service.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * {@inheritdoc}
     */
    public function hydrate(array $attributes = [])
    {
        $attributes['latitude'] = $attributes['lat'];
        $attributes['longitude'] = $attributes['lon'];
        $attributes['country_code'] = $attributes['iso_code'];
        return new Location($attributes);
    }

    /**
     * Get configuration value.
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function config($key, $default = null)
    {
        return Arr::get($this->config, $key, $default);
    }
}
