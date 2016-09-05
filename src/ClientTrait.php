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
     * @var Support\Agent\AgentInterface
     */
    private $agent;

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
    public function setApp($app)
    {
        $this->agent = new Support\Agent\Slim3($app);
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
        $this->agent->sendRequest($method, $url, $data);

        return $this;
    }

    /**
     * Return response body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->agent->getBody();
    }

    /**
     * Get http header of response
     *
     * @param string $name
     * @return array
     */
    public function getResponseHeader($name)
    {
        return $this->agent->getResponseHeader($name);
    }

    /**
     * Get all http header of response
     *
     * @param string $name
     * @return array
     */
    public function getResponseHeaders()
    {
        return $this->agent->getResponseHeaders();
    }

    /**
     * Return status code
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->agent->getStatusCode();
    }

    /**
     * Set cookies
     *
     * @param string $name
     * @param string $value
     */
    public function setCookies($name, $value)
    {
        $this->agent->setCookies($name, $value);
    }

    /**
     * Set http header
     *
     * @param string $name
     * @param string $value
     */
    public function setHeader($name, $value)
    {
        $this->agent->setHeader($name, $value);
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
