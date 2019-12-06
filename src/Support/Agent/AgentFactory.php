<?php

namespace MilesChou\Slim\Test\Support\Agent;

use InvalidArgumentException;

/**
 * Agent factory
 */
class AgentFactory
{
    /**
     * @return AgentInterface
     */
    public function getAgent($app)
    {
        $className = get_class($app);
        switch ($className) {
            case "Slim\\App":
                return new Slim3($app);
            default:
                throw new InvalidArgumentException("Unsupported class: $className");
        }
    }
}
