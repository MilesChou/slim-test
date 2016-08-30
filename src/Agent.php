<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test;

use Slim\Http\Environment;
use Slim\Http\Headers;
use Slim\Http\Request;
use Slim\Http\RequestBody;
use Slim\Http\Response;
use Slim\Http\Uri;

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
    }

    /**
     * Run GET HTTP method
     *
     * @param string $url
     * @param array $data
     * @return Agent
     */
    public function get($url, $data = [])
    {
        return $this->request('GET', $url, $data);
    }

    /**
     * Run POST HTTP method
     *
     * @param string $url
     * @param array $data
     * @return Agent
     */
    public function post($url, $data = [])
    {
        return $this->request('POST', $url, $data);
    }

    /**
     * Run PATCH HTTP method
     *
     * @param string $url
     * @param array $data
     * @return Agent
     */
    public function patch($url, $data = [])
    {
        return $this->request('PATCH', $url, $data);
    }

    /**
     * Run PUT HTTP method
     *
     * @param string $url
     * @param array $data
     * @return Agent
     */
    public function put($url, $data = [])
    {
        return $this->request('PUT', $url, $data);
    }

    /**
     * Run DELETE HTTP method
     *
     * @param string $url
     * @param array $data
     * @return Agent
     */
    public function delete($url, $data = [])
    {
        return $this->request('DELETE', $url, $data);
    }

    /**
     * Run HEAD HTTP method
     *
     * @param string $url
     * @param array $data
     * @return Agent
     */
    public function head($url, $data = [])
    {
        return $this->request('HEAD', $url, $data);
    }

    /**
     * Run OPTIONS HTTP method
     *
     * @param string $url
     * @param array $data
     * @return Agent
     */
    public function options($url, $data = [])
    {
        return $this->request('OPTIONS', $url, $data);
    }

    /**
     * General request
     *
     * @param string $method
     * @param string $url
     * @param array $data
     * @return Agent
     */
    public function request($method, $url, $data = [])
    {
        $environment = Environment::mock(array_merge([
            'REQUEST_METHOD' => $method,
            'REQUEST_URI' => $url,
        ], $this->headers));

        $uri = Uri::createFromEnvironment($environment);
        $headers = Headers::createFromEnvironment($environment);
        $cookies = [];
        $servers = $environment->all();
        $body = new RequestBody();

        $headers->set('Content-Type', 'application/json;charset=utf8');
        $body->write(json_encode($data));

        $this->request  = new Request($method, $uri, $headers, $cookies, $servers, $body);

        $app = $this->app;

        $this->response = $app($this->request, new Response());

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
