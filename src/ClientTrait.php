<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test;

use Slim\App as SlimApp;
use Slim\Http\Environment;
use Slim\Http\Headers;
use Slim\Http\Request;
use Slim\Http\RequestBody;
use Slim\Http\Response;
use Slim\Http\Uri;

/**
 * The client for slim app
 */
trait ClientTrait
{
    /**
     * @var SlimApp
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
     * @var Response
     */
    private $response;

    /**
     * Initailize Client
     *
     * @param SlimApp|null $app
     */
    public function setSlimApp($app)
    {
        $this->app = $app;
    }

    /**
     * Run GET HTTP method
     *
     * @param string $url
     * @param array $data This array will transfer to query string
     * @return this
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
     * @return this
     */
    public function post($url, $data = [])
    {
        return $this->request('POST', $url, $data);
    }

    /**
     * Run PUT HTTP method
     *
     * @param string $url
     * @param array $data
     * @return this
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
     * @return this
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
     * @return this
     */
    public function head($url, $data = [])
    {
        return $this->request('HEAD', $url, $data);
    }

    /**
     * Run PATCH HTTP method
     *
     * @param string $url
     * @param array $data
     * @return this
     */
    public function patch($url, $data = [])
    {
        return $this->request('PATCH', $url, $data);
    }

    /**
     * Run OPTIONS HTTP method
     *
     * @param string $url
     * @param array $data
     * @return this
     */
    public function options($url, $data = [])
    {
        return $this->request('OPTIONS', $url, $data);
    }

    /**
     * General request. Reference from https://github.com/there4/slim-test-helpers/
     *
     * @param string $method
     * @param string $url
     * @param array $data
     * @return this
     */
    public function request($method, $url, $data = [])
    {
        $options = [
            'REQUEST_METHOD' => $method,
            'REQUEST_URI' => $url,
        ];

        if ($method === 'GET') {
            $options['QUERY_STRING'] = http_build_query($data);
        } else {
            $params  = json_encode($data);
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
        $this->request  = new Request($method, $uri, $headers, $cookies, $servers, $body);

        // Build Response via App
        $app = $this->app;
        $this->response = $app($this->request, new Response());

        return $this;
    }

    /**
     * Return response body
     *
     * @return string
     */
    public function getBody()
    {
        return (string) $this->response->getBody();
    }

    /**
     * Get Slim response
     *
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
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
