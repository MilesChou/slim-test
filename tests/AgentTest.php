<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test;

use PHPUnit_Framework_TestCase as TestCase;

class AgentTest extends TestCase
{
    /**
     * @var Agent
     */
    private $target;

    public function setUp()
    {
    }

    public function tearDown()
    {
    }

    public function testItShouldReturnTrueWhenVisitWillReturnOKAndCallFunctionIsOk()
    {
        // Arrange
        $url = '/will/return/ok';
        $app = Factory::getInstance();
        $target = new Agent($app);

        // Act
        $actual = $target->get($url)->isOk();

        // Assert
        $this->assertTrue($actual);
    }

    public function testItShouldReturn500WhenVisitWillReturn500AndCallFunctionGetStatusCode()
    {
        // Arrange
        $url = '/will/return/500';
        $excepted = 500;
        $app = Factory::getInstance();
        $target = new Agent($app);

        // Act
        $actual = $target->get($url)->getStatusCode();

        // Assert
        $this->assertEquals($excepted, $actual);
    }
}
