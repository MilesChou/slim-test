<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test\Constraint;

use PHPUnit_Framework_Constraint;
use Illuminate\Database\Capsule\Manager as Capsule;

class DontSeeInDatabase extends PHPUnit_Framework_Constraint
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $record;

    /**
     * @param array $record DB record
     */
    public function __construct(array $record)
    {
        parent::__construct();

        $this->record = $record;
    }

    /**
     * Evaluates the constraint for parameter $other.
     *
     * @param mixed $other Value or object to evaluate.
     * @return boolean
     */
    protected function matches($other)
    {
        return $other === null;
    }

    /**
     * @return string
     */
    public function toString()
    {
        $str = [];
        foreach ($this->record as $col => $val) {
            $str[] = "$col = $val";
        }

        $str = implode(', ', $str);

        return "not contains $str record";
    }
}
