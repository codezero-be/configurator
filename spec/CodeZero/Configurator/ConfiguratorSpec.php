<?php namespace spec\CodeZero\Configurator;

use CodeZero\Configurator\Loader;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConfiguratorSpec extends ObjectBehavior {

    function let(Loader $loader)
    {
        $this->beConstructedWith($loader, ['set1' => 'val1', 'set2' => 'val2']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('CodeZero\Configurator\Configurator');
    }

    function it_loads_configuration(Loader $loader)
    {
        $config = ['set1' => 'val1', 'set2' => 'val2'];
        $loader->loadConfiguration($config)->shouldBeCalled()->willReturn($config);
        $this->get('set1');
    }

    function it_gets_a_configuration_value(Loader $loader)
    {
        $config = ['set1' => 'val1', 'set2' => 'val2'];
        $loader->loadConfiguration($config)->willReturn($config);
        $this->get('set1')->shouldReturn('val1');
        $this->get('set2')->shouldReturn('val2');
    }

    function it_sets_a_configuration_value_at_runtime(Loader $loader)
    {
        $config = ['set1' => 'val1', 'set2' => 'val2'];
        $loader->loadConfiguration($config)->willReturn($config);
        $this->set('set1', 'newVal');
        $this->get('set1')->shouldReturn('newVal');
    }

}