<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test;

use PHPUnit_Framework_TestCase as PHPUnit;

/**
 * The Assertion for slim app
 */
trait AssertionTrait
{
    /**
     * @param int $actual
     */
    public function dontSeeResponseCodeIs($actual)
    {
        $excepted = $this->getStatusCode();

        PHPUnit::assertNotEquals($excepted, $actual);
    }

    public function dontSeeResponseOk()
    {
        PHPUnit::assertTrue(!$this->isOk());
    }

    /**
     * @param int $actual
     */
    public function seeResponseCodeIs($actual)
    {
        $excepted = $this->getStatusCode();

        PHPUnit::assertEquals($excepted, $actual);
    }

    public function seeResponseOk()
    {
        PHPUnit::assertTrue($this->isOk());
    }
}
