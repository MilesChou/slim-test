<?php

namespace MilesChou\Slim\Test\Constraint;

use PHPUnit\Framework\Constraint\Constraint;

class ResponseCodeIs extends Constraint
{
    /**
     * @var int
     */
    protected $value;

    /**
     * @param int $value HTTP status code
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * Evaluates the constraint for parameter $other.
     *
     * @param mixed $other Value or object to evaluate.
     * @return boolean
     */
    protected function matches($other): bool
    {
        return $other === $this->value;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return "is equal {$this->value} (HTTP status code)";
    }
}
