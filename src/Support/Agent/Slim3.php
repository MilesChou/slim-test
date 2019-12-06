<?php

namespace MilesChou\Slim\Test\Support\Agent;

use Slim\App;
use Slim\Http\Environment;
use Slim\Http\Headers;
use Slim\Http\Request;
use Slim\Http\RequestBody;
use Slim\Http\Response;
use Slim\Http\Uri;

/**
 * Slim3 implement
 */
class Slim3 implements AgentInterface
{
    /**
     * @var App
     */
    private $app;

    /**
     * @var array
     */
    private $cookies = [];

    /**
     * @var array
     */
    private $headers = [];

    /**
     * Constructor
     *
     * @param App|null $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Return response body
     *
     * @return int
     */
    public function getBody()
    {
        return (string)$this->response->getBody();
    }

    /**
     * Get http header of response
     *
     * @param string $name
     * @return array
     */
    public function getResponseHeader($name)
    {
        $header = $this->response->getHeader($name);

        return $header;
    }

    /**
     * Get http header of response
     *
     * @param string $name
     * @return array
     */
    public function getResponseHeaders()
    {
        $header = $this->response->getHeaders();

        return $header;
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
     * General request. Reference from https://github.com/there4/slim-test-helpers/
     *
     * @param string $method
     * @param string $url
     * @param array $data
     */
    public function sendRequest($method, $url, $data = [])
    {
        $options = [
            'REQUEST_METHOD' => $method,
            'REQUEST_URI' => $url,
        ];

        if ($method === 'GET') {
            $options['QUERY_STRING'] = http_build_query($data);
        } else {
            $params = json_encode($data);
        }

        $environment = Environment::mock(array_merge($options, $this->headers));
        $uri = Uri::createFromEnvironment($environment);
        $headers = Headers::createFromEnvironment($environment);
        $cookies = $this->cookies;
        $servers = $environment->all();
        $body = new RequestBody();

        if (isset($params)) {
            $headers->set('Content-Type', 'application/json;charset=utf8');
            $body->write(json_encode($data));
        }

        // Build Request
        $request = new Request($method, $uri, $headers, $cookies, $servers, $body);

        // Build Response via App
        $app = $this->app;
        $this->response = $app($request, new Response());
    }

    /**
     * Set cookies
     *
     * @param string $name
     * @param string $value
     */
    public function setCookies($name, $value)
    {
        $this->cookies[$name] = $value;
    }

    /**
     * Set http header
     *
     * @param string $name
     * @param string $value
     */
    public function setHeader($name, $value)
    {
        $prefix = 'HTTP_';
        $name = $prefix . strtr(strtoupper($name), '-', '_');

        $this->headers[$name] = $value;
    }
}
