<?php

namespace MilesChou\Slim\Test;

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
