<?php

namespace MilesChou\Slim\Test;

use PHPUnit\Framework\TestCase;

/**
 * Testing and demo how to use SlimCase
 */
class SlimCaseTest extends TestCase
{
    /**
     * @var Client
     */
    private $target;

    public function setUp(): void
    {
        $app = require __DIR__ . '/../app.php';
        $this->target = new SlimCase($app);
    }

    public function tearDown(): void
    {
        $this->target = null;
    }

    /**
     * Target method definitions
     */
    public function whenVisitWillReturnOkProvider(): iterable
    {
        yield ['get'];
        yield ['post'];
        yield ['put'];
        yield ['delete'];
        yield ['head'];
        yield ['patch'];
        yield ['options'];
    }

    /**
     * @dataProvider whenVisitWillReturnOkProvider
     * @param string $method
     */
    public function testSeeResponseOkWithAllSupportMethods(string $method)
    {
        // Arrange
        $url = '/will/return/ok';
        $exceptedStatusCode = 200;
        $exceptedBody = strtoupper($method) . ' OK []';
        $method = 'send' . strtoupper($method);

        // Act
        $this->target->$method($url);

        // Assert
        $this->target->seeResponseOk();
        $this->target->seeResponseCodeIs($exceptedStatusCode);
        $this->target->seeResponseContains($exceptedBody);
    }

    public function testDontSeeHttpHeaderName()
    {
        // Arrange
        $url = '/data/empty';
        $notExcepted = 'UnknownHeader';

        // Act
        $this->target->sendGET($url);

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
        $this->target->sendGET($url);

        // Assert
        $this->target->dontSeeHttpHeader('Content-type', $notExcepted);
    }

    public function testDontSeeResponseCodeIs()
    {
        // Arrange
        $url = '/will/return/error';
        $notExcepted = 200;

        // Act
        $this->target->sendGET($url);

        // Assert
        $this->target->dontSeeResponseCodeIs($notExcepted);
    }

    public function testDontSeeResponseContains()
    {
        // Arrange
        $url = '/will/return/ok';

        // Act
        $this->target->sendGET($url);

        // Assert
        $this->target->dontSeeResponseContains('POST');
        $this->target->dontSeeResponseContains('ERROR');
    }

    public function testDontSeeResponseOk()
    {
        // Arrange
        $url = '/will/return/error';

        // Act
        $this->target->sendGET($url);

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
        $this->target->sendGET($url);

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
        $this->target->sendGET($url);

        // Assert
        $this->target->seeResponseCodeIs($excepted);
    }

    public function testSeeResponseContains()
    {
        // Arrange
        $url = '/will/return/ok';

        // Act
        $this->target->sendGET($url);

        // Assert
        $this->target->seeResponseContains('GET');
        $this->target->seeResponseContains('OK');
        $this->target->seeResponseContains('[]');
    }

    public function testSeeResponseTitleIsAndDontSeeResponseTitleIs()
    {
        // Arrange
        $url = '/title/return/sample';

        // Act
        $this->target->sendGET($url);

        // Assert
        $this->target->seeResponseTitleIs('sample');
        $this->target->dontSeeResponseTitleIs('unknown');
    }
}
