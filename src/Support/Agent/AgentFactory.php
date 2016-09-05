<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test\Support\Agent;

use InvalidArgumentException;

/**
 * Agent factory
 */
class AgentFactory
{
    /**
     * @return Agent\AgentInterface
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
