<?php

namespace MilesChou\Slim\Test;

use PHPUnit\Framework\TestCase;

/**
 * Testing and demo how to use ClientTrait
 */
class ClientTraitTest extends TestCase
{
    use ClientTrait;

    public function setUp(): void
    {
        $app = require __DIR__ . '/../app.php';
        $this->setApp($app);
    }

    public function tearDown(): void
    {
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
        $actualTarget = $this->$method($url);
        $actualBody = $actualTarget->getBody();
        $actualStatusCode = $actualTarget->getStatusCode();
        $actualIsOk = $actualTarget->isOk();

        // Assert
        $this->assertEquals($exceptedStatusCode, $actualStatusCode);
        $this->assertEquals($exceptedBody, $actualBody);
        $this->assertTrue($actualIsOk);
    }
}
