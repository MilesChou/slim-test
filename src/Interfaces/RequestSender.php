<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test\Interfaces;

/**
 * As a request handler, it's must be have these function.
 */
interface RequestSender
{
    /**
     * Send GET request
     *
     * @param string $url
     * @param array $data This array will transfer to query string
     */
    public function sendGET($url, $data = []);

    /**
     * Send POST request
     *
     * @param string $url
     * @param array $data
     */
    public function sendPOST($url, $data = []);

    /**
     * Send PUT request
     *
     * @param string $url
     * @param array $data
     */
    public function sendPUT($url, $data = []);

    /**
     * Send DELETE request
     *
     * @param string $url
     * @param array $data
     */
    public function sendDELETE($url, $data = []);

    /**
     * Send HEAD request
     *
     * @param string $url
     * @param array $data
     */
    public function sendHEAD($url, $data = []);

    /**
     * Send PATCH request
     *
     * @param string $url
     * @param array $data
     */
    public function sendPATCH($url, $data = []);

    /**
     * Send OPTIONS request
     *
     * @param string $url
     * @param array $data
     */
    public function sendOPTIONS($url, $data = []);
}
