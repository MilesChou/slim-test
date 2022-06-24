<?php

namespace MilesChou\Slim\Test;

use PHPUnit\Framework\Assert;
use Slim\App;
use Symfony\Component\DomCrawler\Crawler;

/**
 * The Slim's TestCase named SlimCase, using Codeception BDD style.
 *
 * @see http://codeception.com/docs/modules/REST
 */
trait SlimCaseTrait
{
    /**
     * @var App
     */
    private $app;

    /**
     * @var Client
     */
    public $client;

    /**
     * Initialize Client
     *
     * @param App $app
     */
    public function setApp(App $app)
    {
        $this->app = $app;
        $this->client = new Client($app);
    }

    /**
     * Set http header
     *
     * @param string $name
     * @param string $value
     */
    public function haveHeader(string $name, string $value)
    {
        $this->client->setHeader($name, $value);
    }

    /**
     * @param string $exceptedName
     * @param null|string $exceptedValue
     * @param string $message
     */
    public function dontSeeHttpHeader(string $exceptedName, ?string $exceptedValue = null, string $message = '')
    {
        $actual = $this->client->getResponseHeaders();

        $constraint = new Constraint\DontSeeHttpHeader($exceptedName, $exceptedValue);

        Assert::assertThat($actual, $constraint, $message);
    }

    /**
     * @param int $excepted
     * @param string $message
     */
    public function dontSeeResponseCodeIs(int $excepted, string $message = '')
    {
        $actual = $this->client->getStatusCode();

        $constraint = new Constraint\ResponseCodeIsNot($excepted);

        Assert::assertThat($actual, $constraint, $message);
    }

    /**
     * @param string $excepted
     * @param string $message
     */
    public function dontSeeResponseContains(string $excepted, string $message = '')
    {
        $actual = $this->client->getBody();

        $constraint = new Constraint\ResponseNotContains($excepted);

        Assert::assertThat($actual, $constraint, $message);
    }

    /**
     * @param string $message
     */
    public function dontSeeResponseOk(string $message = '')
    {
        $actual = $this->client->getStatusCode();

        $constraint = new Constraint\ResponseIsNotOk();

        Assert::assertThat($actual, $constraint, $message);
    }

    /**
     * @param string $excepted
     * @param string $message
     */
    public function dontSeeResponseTitleIs(string $excepted, string $message = '')
    {
        $body = $this->client->getBody();

        $crawler = new Crawler($body);

        $actual = $crawler->filter('title')->html();

        Assert::assertNotEquals($excepted, $actual, $message);
    }

    /**
     * @param string $exceptedName
     * @param null|string $exceptedValue
     * @param string $message
     */
    public function seeHttpHeader(string $exceptedName, ?string $exceptedValue = null, string $message = '')
    {
        $actual = $this->client->getResponseHeaders();

        $constraint = new Constraint\SeeHttpHeader($exceptedName, $exceptedValue);

        Assert::assertThat($actual, $constraint, $message);
    }

    /**
     * @param int $excepted
     * @param string $message
     */
    public function seeResponseCodeIs(int $excepted, string $message = '')
    {
        $actual = $this->client->getStatusCode();

        $constraint = new Constraint\ResponseCodeIs($excepted);

        Assert::assertThat($actual, $constraint, $message);
    }

    /**
     * @param string $excepted
     * @param string $message
     */
    public function seeResponseContains(string $excepted, string $message = '')
    {
        $actual = $this->client->getBody();

        $constraint = new Constraint\ResponseContains($excepted);

        Assert::assertThat($actual, $constraint, $message);
    }

    /**
     * @param string $message
     */
    public function seeResponseOk(string $message = '')
    {
        $actual = $this->client->getStatusCode();

        $constraint = new Constraint\ResponseIsOk();

        Assert::assertThat($actual, $constraint, $message);
    }

    /**
     * @param string $excepted
     * @param string $message
     */
    public function seeResponseTitleIs(string $excepted, string $message = '')
    {
        $body = $this->client->getBody();

        $crawler = new Crawler($body);

        $actual = $crawler->filter('title')->html();
        $actual = $actual === '' ? null : $actual;

        Assert::assertEquals($excepted, $actual, $message);
    }

    /**
     * Send GET request
     *
     * @param string $url
     * @param array $data This array will transfer to query string
     */
    public function sendGET(string $url, array $data = [])
    {
        $this->client->request('GET', $url, $data);
    }

    /**
     * Send POST request
     *
     * @param string $url
     * @param array $data
     */
    public function sendPOST(string $url, array $data = [])
    {
        $this->client->request('POST', $url, $data);
    }

    /**
     * Send PUT request
     *
     * @param string $url
     * @param array $data
     */
    public function sendPUT(string $url, array $data = [])
    {
        $this->client->request('PUT', $url, $data);
    }

    /**
     * Send DELETE request
     *
     * @param string $url
     * @param array $data
     */
    public function sendDELETE(string $url, array $data = [])
    {
        $this->client->request('DELETE', $url, $data);
    }

    /**
     * Send HEAD request
     *
     * @param string $url
     * @param array $data
     */
    public function sendHEAD(string $url, array $data = [])
    {
        $this->client->request('HEAD', $url, $data);
    }

    /**
     * Send PATCH request
     *
     * @param string $url
     * @param array $data
     */
    public function sendPATCH(string $url, array $data = [])
    {
        $this->client->request('PATCH', $url, $data);
    }

    /**
     * Send OPTIONS request
     *
     * @param string $url
     * @param array $data
     */
    public function sendOPTIONS(string $url, array $data = [])
    {
        $this->client->request('OPTIONS', $url, $data);
    }
}
