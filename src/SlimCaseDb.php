<?php

namespace MilesChou\Slim\Test;

use PHPUnit_Framework_Assert as PHPUnit;
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * DB assertion, Reference from Codeception DB Module
 *
 * @see http://codeception.com/docs/modules/Db
 */
class SlimCaseDb
{
    use SlimCaseDbTrait;
}
