<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace MilesChou\Slim\Test;

use Slim\App;

/**
 * The class Use SlimCase Trait
 *
 * @see http://codeception.com/docs/modules/REST
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
