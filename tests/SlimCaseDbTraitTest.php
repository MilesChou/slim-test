<?php

namespace MilesChou\Slim\Test;

use Illuminate\Database\Capsule\Manager as Capsule;
use PHPUnit\Framework\TestCase;

/**
 * Testing and demo how to use SlimCaseTrait
 */
class SlimCaseDbTraitTest extends TestCase
{
    use SlimCaseDbTrait;

    public function setUp(): void
    {
        // DB Migration
        Capsule::schema()->create('users', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
        });
    }

    public function tearDown(): void
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
