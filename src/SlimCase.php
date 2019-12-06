<?php

namespace MilesChou\Slim\Test;

use Slim\App;

/**
 * The class Use SlimCase Trait
 */
class SlimCase
{
    use SlimCaseTrait;

    /**
     * Constructor
     *
     * @param App $app
     */
    public function __construct($app)
    {
        $this->setApp($app);
    }
}
