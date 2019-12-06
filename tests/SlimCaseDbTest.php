<?php

namespace MilesChou\Slim\Test;

use Illuminate\Database\Capsule\Manager as Capsule;
use PHPUnit\Framework\TestCase;

/**
 * Testing and demostrate how to use SlimCaseTrait
 */
class SlimCaseDbTest extends TestCase
{
    /**
     * @var SlimCaseDb
     */
    private $target;

    public function setUp()
    {
        $slimCaseDb = new SlimCaseDb();
        $this->target = $slimCaseDb;

        // DB Migration
        Capsule::schema()->create('users', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
        });
    }

    public function tearDown()
    {
        $this->target = null;

        // Clear DB
        Capsule::schema()->drop('users');
    }

    public function testHaveInDatabaseAndGrabFromDatabase()
    {
        // Arrange
        $exceptedName = 'Miles';
        $exceptedEmail = 'jangconan@gmail.com';
        $table = 'users';
        $record = [
            'name' => $exceptedName,
            'email' => $exceptedEmail,
        ];

        $this->target->haveInDatabase($table, $record);

        // Act
        $actualName = $this->target->grabFromDatabase($table, 'name', ['email' => $exceptedEmail]);
        $actualEmail = $this->target->grabFromDatabase($table, 'email', ['name' => $exceptedName]);

        // Assert
        $this->assertEquals($exceptedName, $actualName);
        $this->assertEquals($exceptedEmail, $actualEmail);
    }

    public function testSeeInDatabaseAndDontSeeInDatabase()
    {
        // Arrange
        $exceptedName = 'Miles';
        $exceptedEmail = 'jangconan@gmail.com';
        $notExceptedName = 'Unknow-Name';
        $notExceptedEmail = 'Unknow-Email';
        $table = 'users';
        $record = [
            'name' => $exceptedName,
            'email' => $exceptedEmail,
        ];

        $this->target->haveInDatabase($table, $record);

        // Assert
        $this->target->seeInDatabase($table, ['name' => $exceptedName]);
        $this->target->seeInDatabase($table, ['email' => $exceptedEmail]);
        $this->target->dontSeeInDatabase($table, ['name' => $notExceptedName]);
        $this->target->dontSeeInDatabase($table, ['email' => $notExceptedEmail]);
    }
}
