<?php namespace CodeZero\Configurator; 

class Loader {

    /**
     * Load configuration from a file or array
     *
     * @param string|array $config
     *
     * @throws ConfigurationException
     * @return array
     */
    public function loadConfiguration($config)
    {
        if (is_string($config) and file_exists($config))
        {
            $config = include $config;
        }

        if ( ! is_array($config))
        {
            $msg = 'Failed to load configuration data';

            throw new ConfigurationException($msg);
        }

        return $config;
    }

}