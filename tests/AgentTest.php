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
        $app = require __DIR__ . '/slimapp.php';
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
        $actual = $this->target->get($url)->isOk();

        // Assert
        $this->assertTrue($actual);
    }

    public function testItShouldReturn200WhenVisitWillReturnOKAndCallFunctionGetStatusCode()
    {
        // Arrange
        $url = '/will/return/ok';
        $excepted = 200;

        // Act
        $actual = $this->target->get($url)->getStatusCode();

        // Assert
        $this->assertEquals($excepted, $actual);
    }

    public function testItShouldReturn404WhenVisitNotExistPageAndCallFunctionGetStatusCode()
    {
        // Arrange
        $url = '/not/exist/page';
        $excepted = 404;

        // Act
        $actual = $this->target->get($url)->getStatusCode();

        // Assert
        $this->assertEquals($excepted, $actual);
    }

    public function testItShouldReturn500WhenVisitWillReturn500AndCallFunctionGetStatusCode()
    {
        // Arrange
        $url = '/will/return/500';
        $excepted = 500;

        // Act
        $actual = $this->target->get($url)->getStatusCode();

        // Assert
        $this->assertEquals($excepted, $actual);
    }

    public function testItShouldReturnJsonTypeWhenVisitDataEmptyAndCallGetHeader()
    {
        // Arrange
        $url = '/data/empty';
        $excepted = 'application/json';

        // Act
        $this->target->haveHeader('Accept', 'application/json');
        $actual = $this->target->get($url)->getResponesHeader('Content-type')[0];

        // Assert
        $this->assertEquals($excepted, $actual);
    }

    public function testItShouldReturnJsonTypeAndNullWhenVisitDataNullAndCallGetBody()
    {
        // Arrange
        $url = '/data/null';
        $excepted = 'null';

        // Act
        $this->target->haveHeader('Accept', 'application/json');
        $actual = $this->target->get($url)->getBody();

        // Assert
        $this->assertEquals($excepted, $actual);
    }

    public function testItShouldReturnXmlTypeWhenVisitDataNullAndCallGetBody()
    {
        // Arrange
        $url = '/data/null';
        $excepted = "<?xml version=\"1.0\"?>\n<root/>\n";

        // Act
        $this->target->haveHeader('Accept', 'application/xml');
        $actual = $this->target->get($url)->getBody();

        // Assert
        $this->assertEquals($excepted, $actual);
    }

    public function testItShouldReturn500WhenVisitDataNullAndCallGetStatusCode()
    {
        // Arrange
        $url = '/data/null';
        $excepted = 500;

        // Act
        $this->target->haveHeader('Accept', 'application/unknown');
        $actual = $this->target->get($url)->getStatusCode();

        // Assert
        $this->assertEquals($excepted, $actual);
    }
}
