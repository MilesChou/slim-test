<?php
/**
 * @link      https://github.com/MilesChou/slim-test
 * @copyright Copyright (c) 2016 Miles Chou
 * @license   https://github.com/MilesChou/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Miles\Slim\Test;

use Slim\Http\Environment;

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
        return self::$builder();
    }

    /**
     * Init builder
     *
     * @param Closure
     */
    public static function init(Closure $builder)
    {
        self::$builder = $builder;
    }
}
