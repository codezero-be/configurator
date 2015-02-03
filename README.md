# Class Configurator #

[![Build Status](https://travis-ci.org/codezero-be/configurator.svg?branch=master)](https://travis-ci.org/codezero-be/configurator)
[![Latest Stable Version](https://poser.pugx.org/codezero/configurator/v/stable.svg)](https://packagist.org/packages/codezero/configurator)
[![Total Downloads](https://poser.pugx.org/codezero/configurator/downloads.svg)](https://packagist.org/packages/codezero/configurator)
[![License](https://poser.pugx.org/codezero/configurator/license.svg)](https://packagist.org/packages/codezero/configurator)

This package allows you to easily inject configuration files into you own classes.

- [Installation](#installation)
- [Manual Setup](#manual-setup)
- [Laravel 4 Setup](#laravel-4-setup)
- [Usage](#usage)

## Installation ##

Download this package or install it through Composer:

    "require": {
    	"codezero/configurator": "2.*"
    }

## Manual Setup ##

### Create a configuration file ###

Simply create a PHP file anywhere you like, that looks like this:

	<?php
	return [
	    'my_setting' => 'some value',
	    'my_other_setting' => 'some other value'
	];

You can put any key/value pairs in this array. Whatever is needed for your class.

### Instantiate Configurator ###

Create an instance of the `Configurator`, to inject into your own class:

    use CodeZero\Configurator\Configurator;

    $config = '/path/to/your/configFile.php';

    $configurator = new Configurator($config);

## Laravel 4 Setup ##

### IoC binding ###

If you use Laravel, then you can setup a binding that resolves the `Configurator` class and its dependencies. Let's say you have a class `Acme\MyApp\MyClass` that needs a configurator:

	App::bind('Acme\MyApp\MyClass', function($app)
    {
		// Specify an array...
        $config = [
            'my_setting' => 'some value',
            'my_other_setting' => 'some other value'
        ];

		// Or refer to a configuration file...
		$config = '/path/to/configFile.php';

        $configurator = new \CodeZero\Configurator\Configurator($config);

        return new \Acme\MyApp\MyClass($configurator);
    });

### Provide configuration data ###

What if you don't want to hardcode an array or a file path in your bindings, but instead you want to make use of laravels `Config` infrastructure?
Let's imagine that you create a laravel configuration file at `app/config/myapp.php`.

	$config = $app['config']->get("myapp");

Simple as that...

If you are creating packages, it might be helpful to look for a configuration file in the `app/config` folder and provide a backup location. Perhaps your package comes with its own configuration file...

	$config = $app['config']->has("myapp") //=> Check if app/config/myapp.php exists
            ? $app['config']->get("myapp") //=> then fetch it
            : $app['config']->get("myapp::config"); //=> or else fetch the package configuration file

## Usage ##

### Inject the Configurator into your class ###

    use CodeZero\Configurator\Configurator;

    class MyClass {

        public function __construct(Configurator $configurator)
        {
	        $this->configurator = $configurator;
        }
    }

### Get configuration values ###

    $mySetting = $this->configurator->get('my_setting');
    $myOtherSetting = $this->configurator->get('my_other_setting');

### Set configuration values at runtime ###

    $this->configurator->set('my_setting', 'some new value');

And that's all there is to it...

---
[![Analytics](https://ga-beacon.appspot.com/UA-58876018-1/codezero-be/configurator)](https://github.com/igrigorik/ga-beacon)