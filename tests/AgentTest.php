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
        $app = getApp();

        $this->target = new Agent($app);
    }

    public function tearDown()
    {
        $this->target = null;
    }

    public function testItShouldReturnTrueWhenVisitWillReturnOKAndCallFunctionIsOk()
    {
        // Arrange
        $url = '/will/return/ok';

        // Act
        $actual = $this->target->get('/will/return/ok')->isOk();

        $this->assertTrue($actual);
    }
}
