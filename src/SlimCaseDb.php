<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test;

use Illuminate\Database\Capsule\Manager as Capsule;
use Slim\App as SlimApp;

/**
 * The class Use SlimCase Trait
 *
 * @see http://codeception.com/docs/modules/Db
 */
class SlimCaseDb
{
    public function __construct()
    {
        $capsule = new Capsule();
        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => '127.0.0.1',
            'database'  => 'default',
            'username'  => 'root',
            'password'  => 'password',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ], 'default');

        $capsule->setAsGlobal();
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
}
