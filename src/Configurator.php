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
     * @param string|array $config
     * @param Loader $loader
     */
    public function __construct($config, Loader $loader = null)
    {
        $loader = $loader ?: new Loader();
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