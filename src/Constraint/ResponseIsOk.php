<?php

namespace MilesChou\Slim\Test\Constraint;

use PHPUnit\Framework\Constraint\Constraint;

class ResponseIsOk extends Constraint
{
    /**
     * Evaluates the constraint for parameter $other.
     *
     * @param mixed $other Value or object to evaluate.
     * @return boolean
     */
    protected function matches($other): bool
    {
        return $other === 200;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return 'is 200 (HTTP status code)';
    }
}
