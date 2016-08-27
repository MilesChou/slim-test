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
        $app = Factory::getInstance();

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

        // Assert
        $this->assertTrue($actual);
    }
}
