<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test\Support\Agent;

/**
 * Agent interface
 */
interface AgentInterface
{
    /**
     * Get body
     *
     * @return string
     */
    public function getBody();

    /**
     * Get header
     *
     * @param string $name
     * @return array
     */
    public function getResponseHeader($name);

    /**
     * Get header
     *
     * @param string $name
     * @return array
     */
    public function getResponseHeaders();

    /**
     * Get status code
     *
     * @return int
     */
    public function getStatusCode();

    /**
     * Send request
     *
     * @param string $method
     * @param string $url
     * @param array $data
     */
    public function sendRequest($method, $url, $data = []);

    /**
     * Set cookies
     *
     * @param string $name
     * @param string $value
     */
    public function setCookies($name, $value);

    /**
     * Set http header
     *
     * @param string $name
     * @param string $value
     */
    public function setHeader($name, $value);
}
