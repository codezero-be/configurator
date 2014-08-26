<?php namespace CodeZero\Configurator;

class Configurator {

    /**
     * Configuration Array
     *
     * @var array
     */
    protected $config = [];

    /**
     * Constructor
     *
     * @param Loader $loader
     * @param string|array $config
     */
    public function __construct(Loader $loader, $config)
    {
        $this->config = $loader->loadConfiguration($config);
    }

    /**
     * Get a configuration value
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get($key)
    {
        if (array_key_exists($key, $this->config))
        {
            return $this->config[$key];
        }

        return null;
    }

    /**
     * Set a configuration value
     *
     * @param string $key
     * @param string $val
     *
     * @return void
     */
    public function set($key, $val)
    {
        $this->config[$key] = $val;
    }

} 