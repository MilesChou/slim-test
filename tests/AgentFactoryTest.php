<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test;

use PHPUnit_Framework_TestCase as TestCase;

use Framins\Slim\Test\Support\Agent\AgentFactory;

/**
 * Testing and demostrate how to use ClientTrait
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
