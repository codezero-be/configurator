<?php namespace CodeZero\Configurator;

class DefaultConfigurator implements Configurator {

    /**
     * Load configuration from a file or array
     *
     * @param string|array $config
     *
     * @throws ConfigurationException
     * @return Configuration
     */
    public function load($config)
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

        return new Configuration($config);
    }

} 