# Slim Test

[![Build Status](https://travis-ci.org/Framins/slim-test.svg?branch=master)](https://travis-ci.org/Framins/slim-test)

[Slim][] Testing helper.

## Installation with Composer

    composer require framins/slim-test

## Usage

The repository tests is a example, [slimapp.php](/tests/slimapp.php) is a definition use simple Slim router, [SlimCaseTest.php](/tests/SlimCaseTest.php) is testing for `SlimCase` class, and [ClientTest.php](/tests/ClientTest.php) is testing for `Client` class.

First, prepare your Slim App in test code and pass to `SlimCase` constructor.

```php
use Framins\Slim\Test\SlimCase;

class SlimAppTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $app = require __DIR__ . '/slimapp.php';
        $this->target = new SlimCase($app);
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
    $this->target->get($url);

    // Assert
    $this->target->seeResponseOk();
}
```

`SlimCase` use [Proxy Pattern](https://en.wikipedia.org/wiki/Proxy_pattern) to proxy to `Client` object, That means you can use `Client` method by `SlimCase` object. You can see Client example to know how to use.

## License

The Slim Test is licensed under the MIT license. See [License File](LICENSE) for more information.

[Slim]: http://www.slimframework.com/
