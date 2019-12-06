<?php

namespace MilesChou\Slim\Test\Constraint;

use PHPUnit\Framework\Constraint\Constraint;

class ResponseCodeIsNot extends Constraint
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
        return $other !== $this->value;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return "is not equal {$this->value} (HTTP status code)";
    }
}
