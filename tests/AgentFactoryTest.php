<?php

namespace MilesChou\Slim\Test;

use InvalidArgumentException;
use MilesChou\Slim\Test\Support\Agent\AgentFactory;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * Testing and demo how to use ClientTrait
 */
class AgentFactoryTest extends TestCase
{
    /**
     * @var AgentFactory
     */
    private $target;

    public function setUp(): void
    {
        $this->target = new AgentFactory();
    }

    public function tearDown(): void
    {
        $this->target = null;
    }

    public function testException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->target->getAgent(new stdClass());
    }
}
