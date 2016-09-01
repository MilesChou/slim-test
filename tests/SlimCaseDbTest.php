<?php
/**
 * @link      https://github.com/Framins/slim-test
 * @copyright Copyright (c) 2016 Framins
 * @license   https://github.com/Framins/slim-test/blob/master/LICENSE (MIT License)
 */
namespace Framins\Slim\Test;

use PHPUnit_Framework_TestCase as TestCase;

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
        $slimCaseDb = new  SlimCaseDb();
        $this->target = $slimCaseDb;
    }

    public function tearDown()
    {
        $this->target = null;
    }

    /**
     * Reference from Codeception DB Module
     *
     * @see http://codeception.com/docs/modules/Db
     */
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
}
