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
    private $app;

    /**
     * @var \Slim\Container
     */
    private $container;

    /**
     * @var array
     */
    private $headers = [];

    /**
     * @var \Slim\Http\Response
     */
    private $response;

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
     * Run get HTTP method
     *
     * @param string $url
     */
    public function get($url)
    {
        $environmentMock = Environment::mock(array_merge([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI' => $url,
        ], $this->headers));

        $this->container['environment'] = $environmentMock;

        $this->response = $this->app->run(true);

        return $this;
    }

    /**
     * Return response body
     *
     * @return int
     */
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

    /**
     * Set http header mock
     *
     * @param string $name
     * @param string $value
     */
    public function haveHeader($name, $value)
    {
        $prefix = 'HTTP_';
        $name = $prefix . strtr(strtoupper($name), '-', '_');

        $this->headers[$name] = $value;
    }

    /**
     * Get respones http header
     *
     * @param string $name
     * @return array
     */
    public function getResponesHeader($name)
    {
        $header = $this->response->getHeader($name);

        return $header;
    }
}
