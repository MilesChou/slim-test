<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test;

use Slim\Http\Environment;

/**
 * The agent for slim app
 */
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
     * @var \Slim\Http\Response
     */
    protected $response;

    /**
     * Constructor
     *
     * @param \Slim\App $app
     */
    public function __construct($app)
    {
        $this->app = $app;
        $this->container = $app->getContainer();
    }

    /**
     * Assert that the client response has an OK status code.
     */
    public function assertResponseOk()
    {
        $actual = $this->response->getStatusCode();

        Assert::assertTrue($this->response->isOk(), "Expected status code 200, got {$actual}.");
    }

    /**
     * Run get HTTP method
     *
     * @param string $url
     */
    public function get($url)
    {
        $environmentMock = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => $url,
        ]);

        $this->container['environment'] = $environmentMock;

        $this->response = $this->app->run(true);

        return $this;
    }

    public function getBody()
    {
        return (string) $this->response->getBody();
    }

    /**
     * Return status code
     *
     * @return int
     */
    public function getStatusCode()
    {
        $statusCode = $this->response->getStatusCode();

        return $statusCode;
    }

    /**
     * Return true when status code is 200. Otherwise, return false
     *
     * @return boolean
     */
    public function isOk()
    {
        $statusCode = $this->getStatusCode();

        return 200 === $statusCode;
    }
}
