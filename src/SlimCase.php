<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test;

use BadMethodCallException;
use ReflectionClass;
use ReflectionException;
use PHPUnit_Framework_Assert as PHPUnit;
use Framins\Slim\Test\Interfaces\RequestSender;

/**
 * The Slim's TestCase named SlimCase, using Codeception BDD style.
 *
 * @see http://codeception.com/docs/modules/REST
 */
class SlimCase implements RequestSender
{
    use SlimCaseTrait;

    /**
     * Constructor
     *
     * @param \Slim\App $app
     */
    public function __construct(\Slim\App $app)
    {
        $this->setSlimApp($app);
    }
}
