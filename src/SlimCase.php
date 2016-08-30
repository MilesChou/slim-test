<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test;

use BadMethodCallException;
use ReflectionClass;
use ReflectionException;
use PHPUnit_Framework_Assert as PHPUnit;

/**
 * The Slim's TestCase named SlimCase, using Codeception BDD style.
 *
 * @see http://codeception.com/docs/modules/REST
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

    /**
     * Proxy to Client Class
     *
     * @param string $name
     * @param array $args
     */
    public function __call($name, $args)
    {
        try {
            $method = $this->reflectionClient->getMethod($name);
            if ($method->isPublic() && !$method->isAbstract()) {
                return $method->invokeArgs($this->client, $args);
            } else {
                // TODO: Patch test if add new private method in Client class
                throw new BadMethodCallException("Method: '$name' is not public");
            }
        } catch (ReflectionException $e) {
            throw new BadMethodCallException("Method: '$name' is not supported");
        }
    }

    /**
     * @param int $excepted
     * @param string $message
     */
    public function dontSeeResponseCodeIs($excepted, $message = '')
    {
        $excepted = (int) $excepted;
        $actual = $this->getStatusCode();

        $constraint = new Constraint\ResponseCodeIsNot($excepted);

        PHPUnit::assertThat($actual, $constraint, $message);
    }

    /**
     * @param string $message
     */
    public function dontSeeResponseOk($message = '')
    {
        $actual = $this->getStatusCode();

        $constraint = new Constraint\ResponseIsNotOk();

        PHPUnit::assertThat($actual, $constraint, $message);
    }

    /**
     * @param int $excepted
     * @param string $message
     */
    public function seeResponseCodeIs($excepted, $message = '')
    {
        $excepted = (int) $excepted;
        $actual = $this->getStatusCode();

        $constraint = new Constraint\ResponseCodeIs($excepted);

        PHPUnit::assertThat($actual, $constraint, $message);
    }

    /**
     * @param string $message
     */
    public function seeResponseOk($message = '')
    {
        $actual = $this->getStatusCode();

        $constraint = new Constraint\ResponseIsOk();

        PHPUnit::assertThat($actual, $constraint, $message);
    }
}
