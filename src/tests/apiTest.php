<?php
declare(strict_types=1);
namespace SYNQ\tests;

use SYNQ\lib\API;
use PHPUnit\Framework\TestCase;

/**
 * @covers API
 */
final class APITest extends TestCase
{
    public function testConstructorSetsMembers()
    {
        $key = 'testkey';
        $host = 'testHost';
        $api = new API($key, $host);
        $this->assertEquals(1, 1);
    }
}
