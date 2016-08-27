<?php
/**
 * @link      https://github.com/MilesChou/slim-test
 * @copyright Copyright (c) 2016 Miles Chou
 * @license   https://github.com/MilesChou/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Miles\Slim\Test;

use Slim\Http\Environment;

class Agent
{
    /**
     * @var \Slim\App
     */
    protected $app;

    /**
     * @var \Slim\Container
     */
    protected $container;

    /**
     * Constructor
     *
     * @param \Slim\App $app
     */
    public function __construct($app)
    {
        $this->app = $app;
        $this->container = $this->app->getContainer();
    }

    /**
     * Assert that the client response has an OK status code.
     */
    public function assertResponseOk()
    {
        $actual = $this->response->getStatusCode();
        Assert::assertTrue($this->response->isOk(), "Expected status code 200, got {$actual}.");
    }

    public function get($url)
    {
        $environmentMock = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => $url,
        ]);
        $this->container['environment'] = $environmentMock;

        $this->app->run(true);

        return $this;
    }

    public function isOk()
    {
        $statusCode = $this->container['response']->getStatusCode();

        return 200 === $statusCode;
    }
}
