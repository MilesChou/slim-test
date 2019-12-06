<?php

namespace MilesChou\Slim\Test;

use PHPUnit\Framework\Assert;
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * DB assertion, Reference from Codeception DB Module
 *
 * @see http://codeception.com/docs/modules/Db
 */
trait SlimCaseDbTrait
{
    /**
     * Asserts that a row with the given column values exists
     *
     * @param string $table
     * @param array $record
     */
    public function dontSeeInDatabase($table, array $record, $message = '')
    {
        $select = Capsule::table($table)->select(Capsule::raw('COUNT(*) as num'));

        foreach ($record as $whereColumn => $value) {
            $select->where($whereColumn, '=', $value);
        }

        $data = $select->first();
        $actual = $data->num > 0 ? true : null;

        $constraint = new Constraint\DontSeeInDatabase($record);

        Assert::assertThat($actual, $constraint, $message);
    }

    /**
     * Fetches a single column value from a database
     *
     * @param string $table
     * @param string $colume
     * @param array $condition
     */
    public function grabFromDatabase($table, $column, array $condition)
    {
        $select = Capsule::table($table)->select();

        foreach ($condition as $whereColumn => $value) {
            $select->where($whereColumn, '=', $value);
        }

        $data = $select->first();

        return $data->$column;
    }

    /**
     * Inserts an SQL record into a database
     *
     * @param string $table
     * @param array $record
     */
    public function haveInDatabase($table, array $record)
    {
        Capsule::table($table)->insert($record);
    }

    /**
     * Asserts that a row with the given column values exists
     *
     * @param string $table
     * @param array $record
     */
    public function seeInDatabase($table, array $record, $message = '')
    {
        $select = Capsule::table($table)->select(Capsule::raw('COUNT(*) as num'));

        foreach ($record as $whereColumn => $value) {
            $select->where($whereColumn, '=', $value);
        }

        $data = $select->first();
        $actual = $data->num > 0 ? true : null;

        $constraint = new Constraint\SeeInDatabase($record);

        Assert::assertThat($actual, $constraint, $message);
    }
}
