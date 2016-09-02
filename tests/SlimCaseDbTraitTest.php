<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test;

use PHPUnit_Framework_TestCase as TestCase;
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Testing and demostrate how to use SlimCaseTrait
 */
class SlimCaseDbTraitTest extends TestCase
{
    use SlimCaseDbTrait;

    public function setUp()
    {
        // DB Migration
        Capsule::schema()->create('users', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
        });
    }

    public function tearDown()
    {
        // Clear DB
        Capsule::schema()->drop('users');
    }

    public function testSeeInDatabaseAndDontSeeInDatabase()
    {
        // Arrange
        $exceptedName = 'Miles';
        $exceptedEmail = 'jangconan@gmail.com';
        $table = 'users';
        $record = [
            'name' => $exceptedName,
            'email' => $exceptedEmail,
        ];

        $this->haveInDatabase($table, $record);

        // Assert
        $this->seeInDatabase($table, ['name' => $exceptedName]);
        $this->seeInDatabase($table, ['email' => $exceptedEmail]);
    }
}
