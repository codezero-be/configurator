# Class Configurator #

[![Build Status](https://travis-ci.org/codezero-be/configurator.svg?branch=master)](https://travis-ci.org/codezero-be/configurator)
[![Latest Stable Version](https://poser.pugx.org/codezero/configurator/v/stable.svg)](https://packagist.org/packages/codezero/configurator)
[![Total Downloads](https://poser.pugx.org/codezero/configurator/downloads.svg)](https://packagist.org/packages/codezero/configurator)
[![License](https://poser.pugx.org/codezero/configurator/license.svg)](https://packagist.org/packages/codezero/configurator)

This package allows you to easily inject configuration files into you own classes.

- [Installation](#installation)
- [Usage](#usage)
- [Laravel 4 Setup](#laravel-4-setup)

## Installation ##

Download this package or install it through Composer:

    "require": {
    	"codezero/configurator": "3.*"
    }

## Usage ##

### Define a configuration ###

Specify an array...

    $config = [
        'my_setting' => 'some value',
        'my_other_setting' => 'some other value'
    ];

Or refer to a configuration file...

    $config = '/path/to/configFile.php';

That configuration file could look like this:

    <?php
    return [
        'my_setting' => 'some value',
        'my_other_setting' => 'some other value'
    ];

### Use `Configurator` in your class ###

Inject a `Configurator` implementation in your class. If none is supplied, the default one will be instantiated. The `$configurator->load()` method will return a `Configuration` object or throw a `ConfigurationException` if no valid array could be loaded.

    use CodeZero\Configurator\Configurator;
    use CodeZero\Configurator\DefaultConfigurator;

    class MyClass {

        private $config;

        public function __construct($config, Configurator $configurator = null)
        {
	        $configurator = $configurator ?: new DefaultConfigurator();
            $this->config = $configurator->load($config);
        }
    }

### Instantiate your class ###

Create an instance of your class, passing it the [configuration array or file](#define-a-configuration):

    $myClass = new MyClass($config);

### Use the `Configuration` in your class ###

Get configuration values:

    $mySetting = $this->config->get('my_setting');
    $myOtherSetting = $this->config->get('my_other_setting');

Set configuration values at runtime:

    $this->config->set('my_setting', 'some new value');

And that's all there is to it...

## Laravel 4 Setup ##

### IoC binding ###

If you use Laravel, then you can setup a binding that resolves your class with its configuration automatically. Let's say you have a class `Acme\MyApp\MyClass`:

	App::bind('Acme\MyApp\MyClass', function($app)
    {
		// Specify an array...
        $config = [
            'my_setting' => 'some value',
            'my_other_setting' => 'some other value'
        ];

		// Or refer to a configuration file...
		$config = '/path/to/configFile.php';

        return new \Acme\MyApp\MyClass($config);
    });

### Use Laravel's `Config` infrastructure ###

What if you don't want to hardcode an array or a file path in your bindings, but instead you want to make use of laravel's `Config` infrastructure?
Let's imagine that you create a Laravel configuration file at `app/config/myapp.php`. You could then use this in your binding:

	$config = $app['config']->get("myapp");

Simple as that...

If you are creating packages, it might be helpful to look for a configuration file in the `app/config` folder and provide a backup location. Perhaps your package comes with its own configuration file...

	$config = $app['config']->has("myapp")
            ? $app['config']->get("myapp")
            : $app['config']->get("myapp::config");

> This will check if app/config/myapp.php exists and then fetch it, or else it will try and fetch the package configuration file.

---
[![Analytics](https://ga-beacon.appspot.com/UA-58876018-1/codezero-be/configurator)](https://github.com/igrigorik/ga-beacon)