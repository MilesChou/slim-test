<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test\Constraint;

use PHPUnit_Framework_Constraint;
use PHPUnit_Util_InvalidArgumentHelper;

class ResponseCodeIs extends PHPUnit_Framework_Constraint
{
    /**
     * @var int
     */
    protected $value;

    /**
     * @param int $value HTTP status code
     */
    public function __construct($value)
    {
        parent::__construct();

        $this->value = $value;
    }

    /**
     * Evaluates the constraint for parameter $other.
     *
     * @param mixed $other Value or object to evaluate.
     * @return boolean
     */
    protected function matches($other)
    {
        return $other === $this->value;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return "is equal {$this->value} (HTTP status code)";
    }
}
