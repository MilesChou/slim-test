<?php
/**
 * @link      https://github.com/MilesChou/slim-test
 * @copyright Copyright (c) 2016 Miles Chou
 * @license   https://github.com/MilesChou/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Miles\Slim\Test;

use PHPUnit_Framework_TestCase as TestCase;

class AgentTest extends TestCase
{
    /**
     * @var Agent
     */
    private $target;

    public function setUp()
    {
        $this->target = new Agent();
    }

    public function tearDown()
    {
        $this->target = null;
    }

    public function testFooBar()
    {
        $this->assertTrue(true);
    }
}
