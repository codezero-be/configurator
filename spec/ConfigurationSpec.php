<?php

namespace spec\CodeZero\Configurator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConfigurationSpec extends ObjectBehavior {

    function let()
    {
        $this->beConstructedWith(['set1' => 'val1', 'set2' => 'val2']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('CodeZero\Configurator\Configuration');
    }

    function it_gets_a_configuration_value()
    {
        $this->get('set1')->shouldReturn('val1');
        $this->get('set2')->shouldReturn('val2');
    }

    function it_sets_a_configuration_value_at_runtime()
    {
        $this->set('set1', 'newVal');
        $this->get('set1')->shouldReturn('newVal');
    }

}
