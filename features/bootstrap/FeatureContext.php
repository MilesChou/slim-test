<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Framins\Slim\Test\SlimCaseTrait;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    use SlimCaseTrait;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $app = require __DIR__ . '/../../app.php';
        $this->setSlimApp($app);
    }

    /**
     * @Given a route named :url
     */
    public function aRouteNamed($url)
    {
        // Do nothing
    }

    /**
     * @When visit :url
     */
    public function visit($url)
    {
        $this->sendGET($url);
    }

    /**
     * @Then I should see response okay
     */
    public function iShouldSeeResponseOkay()
    {
        $this->seeResponseOk();
    }

    /**
     * @Then I should not see response okay
     */
    public function iShouldNotSeeResponseOkay()
    {
        $this->dontSeeResponseOk();
    }

    /**
     * @Then I should see response title is :title
     */
    public function iShouldSeeResponseTitleIs($title)
    {
        $this->seeResponseTitleIs($title);
    }

    /**
     * @When post :url
     */
    public function post($url)
    {
        $this->sendPOST($url);
    }

    /**
     * @Then I should see response data contain :string
     */
    public function iShouldSeeResponseDataContain($string)
    {
        $this->seeResponseContains($string);
    }
}
