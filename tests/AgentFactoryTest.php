<?php

namespace MilesChou\Slim\Test;

use MilesChou\Slim\Test\Support\Agent\AgentFactory;
use PHPUnit\Framework\TestCase;

/**
 * Testing and demo how to use ClientTrait
 */
class AgentFactoryTest extends TestCase
{
    /**
     * @var AgentFactory
     */
    private $target;

    public function setUp()
    {
        $this->target = new AgentFactory();
    }

    public function tearDown()
    {
        $this->target = null;
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessageRegExp /stdClass/
     */
    public function testException()
    {
        $this->target->getAgent(new \stdClass());
    }
}
