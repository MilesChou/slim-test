<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test;

use ReflectionClass;
use BadMethodCallException;
use PHPUnit_Framework_Assert as PHPUnit;

/**
 * The Slim's TestCase named SlimCase
 */
class SlimCase
{
    /**
     * @var \Slim\App
     */
    private $app;

    /**
     * @var Client
     */
    public $client;

    /**
     * @var ReflectionClass
     */
    public $reflectionClient;

    /**
     * Constructor
     *
     * @param \Slim\App $app
     */
    public function __construct(\Slim\App $app)
    {
        $this->app = $app;
        $this->client = new Client($app);
        $this->reflectionClient = new ReflectionClass($this->client);
    }

    public function __call($name, $args)
    {
        if ($method = $this->reflectionClient->getMethod($name)) {
            if ($method->isPublic() && !$method->isAbstract()) {
                return $method->invokeArgs($this->client, $args);
            }
        } else {
            throw new BadMethodCallException("Method: '$method' is not supported");
        }
    }

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
