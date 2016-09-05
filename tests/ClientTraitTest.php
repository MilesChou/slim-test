<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test;

use PHPUnit_Framework_TestCase as TestCase;

/**
 * Testing and demostrate how to use ClientTrait
 */
class ClientTraitTest extends TestCase
{
    use ClientTrait;

    public function setUp()
    {
        $app = require __DIR__ . '/../app.php';
        $this->setApp($app);
    }

    public function tearDown()
    {
        $this->setApp(null);
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
