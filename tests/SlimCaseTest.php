<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test;

use PHPUnit_Framework_TestCase as TestCase;

class SlimCaseTest extends TestCase
{
    /**
     * @var Client
     */
    private $target;

    public function setUp()
    {
        $app = require __DIR__ . '/../app.php';
        $this->target = new SlimCase($app);
    }

    public function tearDown()
    {
        $this->target = null;
    }

    /**
     * @expectedException BadMethodCallException
     * @expectedExceptionMessageRegExp /undefinedMethod/
     */
    public function testUndefinedMethod()
    {
        // Act & Assert
        $this->target->undefinedMethod();
    }

    public function testDontSeeHttpHeaderName()
    {
        // Arrange
        $url = '/data/empty';
        $notExcepted = 'UnknownHeader';

        // Act
        $this->target->get($url);

        // Assert
        $this->target->dontSeeHttpHeader($notExcepted);
    }

    public function testDontSeeHttpHeaderValue()
    {
        // Arrange
        $url = '/data/empty';
        $notExcepted = 'application/xml';

        // Act
        $this->target->haveHeader('Accept', 'application/json');
        $this->target->get($url);

        // Assert
        $this->target->dontSeeHttpHeader('Content-type', $notExcepted);
    }

    public function testDontSeeResponseCodeIs()
    {
        // Arrange
        $url = '/will/return/error';
        $notExcepted = 200;

        // Act
        $this->target->get($url);

        // Assert
        $this->target->dontSeeResponseCodeIs($notExcepted);
    }

    public function testDontSeeResponseContains()
    {
        // Arrange
        $url = '/will/return/ok';

        // Act
        $this->target->get($url);

        // Assert
        $this->target->dontSeeResponseContains('POST');
        $this->target->dontSeeResponseContains('ERROR');
    }

    public function testDontSeeResponseOk()
    {
        // Arrange
        $url = '/will/return/error';

        // Act
        $this->target->get($url);

        // Assert
        $this->target->dontSeeResponseOk();
    }

    public function testSeeHttpHeader()
    {
        // Arrange
        $url = '/data/empty';
        $exceptedName = 'Content-type';
        $exceptedValue = 'application/json';

        // Act
        $this->target->haveHeader('Accept', 'application/json');
        $this->target->get($url);

        // Assert
        $this->target->seeHttpHeader($exceptedName);
        $this->target->seeHttpHeader($exceptedName, $exceptedValue);
    }

    public function testSeeResponseCodeIs()
    {
        // Arrange
        $url = '/will/return/ok';
        $excepted = 200;

        // Act
        $this->target->get($url);

        // Assert
        $this->target->seeResponseCodeIs($excepted);
    }

    public function testSeeResponseContains()
    {
        // Arrange
        $url = '/will/return/ok';

        // Act
        $this->target->get($url);

        // Assert
        $this->target->seeResponseContains('GET');
        $this->target->seeResponseContains('OK');
        $this->target->seeResponseContains('[]');
    }

    public function testSeeResponseOk()
    {
        // Arrange
        $url = '/will/return/ok';

        // Act
        $this->target->get($url);

        // Assert
        $this->target->seeResponseOk();
    }
}
