<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test;

use Slim\App as SlimApp;

/**
 * The client for slim app
 */
class Client
{
    use ClientTrait;

    /**
     * Constructor
     *
     * @param SlimApp|null $app
     */
    public function __construct($app)
    {
        $this->setApp($app);
    }
}
