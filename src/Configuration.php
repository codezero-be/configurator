<?php namespace CodeZero\Configurator; 

class Configuration {

    /**
     * Configuration array
     *
     * @var array
     */
    private $config;

    /**
     * Constructor
     *
     * @param array $config
     */
    public function __construct($config)
    {
        $this->config = $config;
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