<?php

namespace MilesChou\Slim\Test\Constraint;

use PHPUnit\Framework\Constraint\Constraint;

class ResponseContains extends Constraint
{
    /**
     * @var string
     */
    protected $string;

    /**
     * @param string $string
     */
    public function __construct(string $string)
    {
        $this->string = $string;
    }

    /**
     * Evaluates the constraint for parameter $other.
     *
     * @param mixed $other Value or object to evaluate.
     * @return boolean
     */
    protected function matches($other): bool
    {
        return strpos($other, $this->string) !== false;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return "is contains '{$this->string}' string";
    }
}
