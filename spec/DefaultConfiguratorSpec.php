<?php namespace spec\CodeZero\Configurator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DefaultConfiguratorSpec extends ObjectBehavior {

    function it_is_initializable()
    {
        $this->shouldHaveType('CodeZero\Configurator\DefaultConfigurator');
    }

    function it_loads_an_array()
    {
        $config = ['set1' => 'val1', 'set2' => 'val2'];
        $this->load($config)->shouldReturnAnInstanceOf('\CodeZero\Configurator\Configuration');
    }

    function it_loads_an_array_from_a_file()
    {
        $file = __DIR__ . '/TestConfig.php';
        $this->load($file)->shouldReturnAnInstanceOf('\CodeZero\Configurator\Configuration');
    }

    function it_throws_if_no_array_can_be_returned()
    {
        $config = 'faulty';
        $this->shouldThrow('CodeZero\Configurator\ConfigurationException')->duringLoad($config);
    }

}