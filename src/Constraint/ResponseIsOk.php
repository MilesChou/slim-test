<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test\Constraint;

use PHPUnit_Framework_Constraint;

class ResponseIsOk extends PHPUnit_Framework_Constraint
{
    /**
     * Evaluates the constraint for parameter $other.
     *
     * @param mixed $other Value or object to evaluate.
     * @return boolean
     */
    protected function matches($other)
    {
        return $other === 200;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return 'is 200 (HTTP status code)';
    }
}
