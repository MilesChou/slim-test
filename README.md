# Slim Test

[![Latest Stable Version](https://poser.pugx.org/mileschou/slim-test/v/stable)](https://packagist.org/packages/mileschou/slim-test)
[![Build Status](https://travis-ci.org/MilesChou/slim-test.svg?branch=master)](https://travis-ci.org/MilesChou/slim-test)
[![codecov](https://codecov.io/gh/MilesChou/slim-test/branch/master/graph/badge.svg)](https://codecov.io/gh/MilesChou/slim-test)
[![License](https://poser.pugx.org/mileschou/slim-test/license)](https://packagist.org/packages/mileschou/slim-test)

A simple test helper for [Slim Framework 3][Slim]

The repository has some example in `tests` folder. [app.php](/app.php) is a definition use simple Slim router, [SlimCaseTest.php](/tests/SlimCaseTest.php) is testing for `SlimCase` class, and [ClientTest.php](/tests/ClientTest.php) is testing for `Client` class. You can use `Client` If you want to use PHPUnit style to write test, or use `SlimCase` in Codeception style.

## Installation with Composer

    $ composer require --dev mileschou/slim-test

## Using object in PHPUnit

First, prepare your Slim App in test code and pass to `SlimCase` constructor.

```php
use MilesChou\Slim\Test\SlimCase;

class SlimAppTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $app = require 'path/to/app.php';
        $this->slimCase = new SlimCase($app);
    }
}
```

Now, you can use [Codeception Style](http://codeception.com/docs/modules/REST) to make assertion.

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

> It's unsafe to access client object **directly**. The visibility will modify to `private` in the future.

## Using trait in PHPUnit

You can use `ClientTrait` or `SlimCaseTrait` in PHPUnit, too. Here is an example:

```php
use MilesChou\Slim\Test\SlimCaseTrait;

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

    public function testSeeResponseOk()
    {
        // Arrange
        $url = '/will/return/ok';

        // Act
        $this->sendGET($url);

        // Assert
        $this->seeResponseOk();
    }
}
```

## Using in Behat

It's easy to using Slim Test in [Behat][]. For example, I have a feature file

```feature
# features/app.feature
Feature: an example testing use behat

  Scenario: Test assert response is okay
    Given a route named "/will/return/ok"
    When visit "/will/return/ok"
    Then I should see response okay
```

And implement context file easily

```php
// features/bootstrap/FeatureContext.php
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use MilesChou\Slim\Test\SlimCaseTrait;

class FeatureContext implements Context, SnippetAcceptingContext
{
    use SlimCaseTrait;

    public function __construct()
    {
        // bootstrap your slim app
        $app = require __DIR__ . '/../../app.php';
        $this->setSlimApp($app);
    }

    /** @Given a route named :url */
    public function aRouteNamed($url) { /** Do nothing */ }

    /** @When visit :url */
    public function visit($url)
    {
        $this->sendGET($url);
    }

    /** @Then I should see response okay */
    public function iShouldSeeResponseOkay()
    {
        $this->seeResponseOk();
    }
}
```

## Tests

Execute all test suite use [PHPUnit][] and [Behat][]

    $ php vendor/bin/phpunit
    $ php vendor/bin/behat

You can use composer scripts, too

    $ composer test

Run PHP built-in server if you want to check HTTP response via browser

    $ php -S 0.0.0.0:8080 -t public

## License

The Slim Test is licensed under the MIT license. See [License File](LICENSE) for more information.

[Behat]: http://docs.behat.org/
[PHPUnit]: https://phpunit.de/
[Slim]: http://www.slimframework.com/
