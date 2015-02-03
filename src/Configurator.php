<?php namespace CodeZero\Configurator;

interface Configurator {

    /**
     * Load configuration from a file or array
     *
     * @param string|array $config
     *
     * @throws ConfigurationException
     * @return Configuration
     */
    public function load($config);

}