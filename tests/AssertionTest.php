<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test;

use PHPUnit_Framework_TestCase as TestCase;

class AssertionTest extends TestCase
{
    /**
     * @var Client
     */
    private $target;

    public function setUp()
    {
        $app = require __DIR__ . '/slimapp.php';
        $this->target = new Client($app);
    }

    public function tearDown()
    {
        $this->target = null;
    }

    public function testDontSeeResponseCodeIs()
    {
        // Arrange
        $url = '/will/return/error';

        // Act
        $this->target->get($url);

        // Assert
        $this->target->dontSeeResponseCodeIs(200);
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

    public function testSeeResponseCodeIs()
    {
        // Arrange
        $url = '/will/return/ok';

        // Act
        $this->target->get($url);

        // Assert
        $this->target->seeResponseCodeIs(200);
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