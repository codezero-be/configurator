<?php namespace spec\CodeZero\Configurator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LoaderSpec extends ObjectBehavior {

    function it_is_initializable()
    {
        $this->shouldHaveType('CodeZero\Configurator\Loader');
    }

    function it_returns_an_array()
    {
        $config = ['set1' => 'val1', 'set2' => 'val2'];
        $this->loadConfiguration($config)->shouldReturn($config);
    }

    function it_loads_an_array_from_a_file()
    {
        $file = __DIR__ . '/TestConfig.php';
        $config = ['set1' => 'val1', 'set2' => 'val2'];
        $this->loadConfiguration($file)->shouldReturn($config);
    }

    function it_throws_if_no_array_can_be_returned()
    {
        $config = 'set1';
        $this->shouldThrow('CodeZero\Configurator\ConfigurationException')->duringLoadConfiguration($config);
    }

}