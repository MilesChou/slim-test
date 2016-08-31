# Slim Test

[![Build Status](https://travis-ci.org/Framins/slim-test.svg?branch=master)](https://travis-ci.org/Framins/slim-test)
[![Coverage Status](https://coveralls.io/repos/github/Framins/slim-test/badge.svg?branch=master)](https://coveralls.io/github/Framins/slim-test?branch=master)

A [Slim][] helper for test router.

The repository has some example in `tests` folder. [app.php](/app.php) is a definition use simple Slim router, [SlimCaseTest.php](/tests/SlimCaseTest.php) is testing for `SlimCase` class, and [ClientTest.php](/tests/ClientTest.php) is testing for `Client` class. You can use `Client` If you want to use PHPUnit style to write test, or use `SlimCase` in Codeception style.

## Installation with Composer

    $ composer require framins/slim-test

## Using object to test

First, prepare your Slim App in test code and pass to `SlimCase` constructor.

```php
use Framins\Slim\Test\SlimCase;

class SlimAppTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $app = require 'path/to/app.php';
        $this->slimCase = new SlimCase($app);
    }
}
```

Then, you can use [Codeception Style](http://codeception.com/docs/modules/REST) to make assertion.

```php
public function testSeeResponseOk()
{
    // Arrange
    $url = '/will/return/ok';

    // Act
    $this->slimCase->sendGET($url);

    // Assert
    $this->slimCase->seeResponseOk();
}
```

The visibility of `Client` object in `SlimCase` is public. That means you can use `Client` like

```php
$this->slimCase->client->get($url);
```

> It's unsafe to access Client Object directly. The visibility will modify to `private` in the future.

## Using trait to test

You can use `ClientTrait` or `SlimCaseTrait` to test. Here is an example:

```php
use Framins\Slim\Test\SlimCaseTrait;

class SlimAppTest extends PHPUnit_Framework_TestCase
{
    use SlimCaseTrait;

    public function setUp()
    {
        $app = require 'path/to/app.php';
        $this->setSlimApp($app);
    }

    public function tearDown()
    {
        $this->setSlimApp(null);
    }

    public function testFooWillBar()
    {
        $this->sendGET('Foo');
        $this->seeResponseContains('Bar');
    }
}
```


## Tests

Execute the test suite use [PHPUnit][]

    $ php vendor/bin/phpunit

Run PHP built-in server if you want to check HTTP response via browser

    $ php -S 0.0.0.0:8080 -t public

## License

The Slim Test is licensed under the MIT license. See [License File](LICENSE) for more information.

[PHPUnit]: https://phpunit.de/
[Slim]: http://www.slimframework.com/
