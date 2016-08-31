<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test;

use Slim\App as SlimApp;

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
     * @param SlimApp $app
     */
    public function __construct(SlimApp $app)
    {
        $this->setSlimApp($app);
    }
}
