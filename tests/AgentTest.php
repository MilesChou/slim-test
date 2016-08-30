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

    public function testItShouldReturn404WhenVisitNotExistPageAndCallGetStatusCode()
    {
        // Arrange
        $url = '/not/exist/page';
        $excepted = 404;

        // Act
        $actual = $this->target->get($url)->getStatusCode();

        // Assert
        $this->assertEquals($excepted, $actual);
    }

    public function testItShouldReturn500WhenVisitWillReturn500AndCallGetStatusCode()
    {
        // Arrange
        $url = '/will/return/500';
        $excepted = 500;

        // Act
        $actual = $this->target->get($url)->getStatusCode();

        // Assert
        $this->assertEquals($excepted, $actual);
    }

    /**
     * Target method definitions
     */
    public function whenVisitWillReturnOkProvider()
    {
        return [
            ['get'],
            ['post'],
            ['put'],
            ['delete'],
            ['head'],
            ['patch'],
            ['options'],
        ];
    }

    /**
     * Test 200 ok response with all method
     *
     * @dataProvider whenVisitWillReturnOkProvider
     * @param string $method
     */
    public function testItShouldReturnMethodOkWhenVisitWillReturnOkAndCallGetBody($method)
    {
        // Arrange
        $url = '/will/return/ok';
        $exceptedBody = strtoupper($method) . ' OK []';
        $exceptedStatusCode = 200;

        // Act
        $actualTarget = $this->target->$method($url);
        $actualBody = $actualTarget->getBody();
        $actualStatusCode = $actualTarget->getStatusCode();
        $actualIsOk = $actualTarget->isOk();

        // Assert
        $this->assertEquals($exceptedStatusCode, $actualStatusCode);
        $this->assertEquals($exceptedBody, $actualBody);
        $this->assertTrue($actualIsOk);
    }

    /**
     * Test 200 ok response and data string with all method and simple data
     *
     * @dataProvider whenVisitWillReturnOkProvider
     * @param string $method
     */
    public function testItShouldReturnMethodOkAndDataStringWhenVisitWillReturnOkByDataAndCallGetBody($method)
    {
        // Arrange
        $url = '/will/return/ok';
        $data = ['data' => ['foo', 'bar']];
        $exceptedBody = strtoupper($method) . ' OK ' . json_encode($data);
        $exceptedStatusCode = 200;

        // Act
        $actualTarget = $this->target->$method($url, $data);
        $actualBody = $actualTarget->getBody();
        $actualStatusCode = $actualTarget->getStatusCode();
        $actualIsOk = $actualTarget->isOk();

        // Assert
        $this->assertEquals($exceptedStatusCode, $actualStatusCode);
        $this->assertEquals($exceptedBody, $actualBody);
        $this->assertTrue($actualIsOk);
    }

    /**
     * Test 200 ok response and data string with all method and simple data
     *
     * @dataProvider whenVisitWillReturnOkProvider
     * @param string $method
     */
    public function testItShouldReturnCookiesDataStringWhenVisitWillReturnOkByCookiesAndCallGetBody($method)
    {
        // Arrange
        $url = '/will/return/cookies';
        $cookiesName = 'cookies';
        $cookiesValue = ['foo', 'bar'];
        $exceptedBody = strtoupper($method) . ' COOKIES ' . json_encode([$cookiesName => $cookiesValue]);

        // Act
        $this->target->haveCookies($cookiesName, $cookiesValue);
        $this->target->$method($url);
        $actualBody = $this->target->getBody();

        // Assert
        $this->assertEquals($exceptedBody, $actualBody);
    }

    /**
     * Test 500 error response with all method
     *
     * @dataProvider whenVisitWillReturnOkProvider
     * @param string $method
     */
    public function testItShouldReturnMethodErrorWhenVisitWillReturnErrorAndCallGetBody($method)
    {
        // Arrange
        $url = '/will/return/error';
        $exceptedBody = strtoupper($method) . ' ERROR []';
        $exceptedStatusCode = 500;

        // Act
        $actualTarget = $this->target->$method($url);
        $actualBody = $actualTarget->getBody();
        $actualStatusCode = $actualTarget->getStatusCode();

        // Assert
        $this->assertEquals($exceptedStatusCode, $actualStatusCode);
        $this->assertEquals($exceptedBody, $actualBody);
    }

    /**
     * Test header
     */
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
