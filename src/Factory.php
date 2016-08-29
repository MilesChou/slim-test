<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test;

use Slim\Http\Environment;

/**
 * This factory is use to global access Slim app, but it's only valid PHP >= 7.0 / HHVM ...
 */
class Factory
{
    /**
     * @var Closure Slim App builder
     */
    private static $builder;

    /**
     * Get Slim App instance for testing
     *
     * @return Slim\App
     */
    public static function getInstance()
    {
        $build = self::$builder;

        return $build();
    }

    /**
     * Init builder
     *
     * @param Closure
     */
    public static function init(callable $builder)
    {
        self::$builder = $builder;
    }
}
