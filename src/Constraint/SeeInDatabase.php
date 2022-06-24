<?php

namespace MilesChou\Slim\Test\Constraint;

use PHPUnit\Framework\Constraint\Constraint;

class SeeInDatabase extends Constraint
{
    /**
     * @var array
     */
    protected $record;

    /**
     * @param array $record DB record
     */
    public function __construct(array $record)
    {
        $this->record = $record;
    }

    /**
     * Evaluates the constraint for parameter $other.
     *
     * @param mixed $other Value or object to evaluate.
     * @return boolean
     */
    protected function matches($other): bool
    {
        return $other !== null;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        $str = [];
        foreach ($this->record as $col => $val) {
            $str[] = "$col = $val";
        }

        $str = implode(', ', $str);

        return "contains $str record";
    }
}
