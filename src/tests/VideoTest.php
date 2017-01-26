<?php
declare(strict_types=1);
namespace SYNQ\tests;

use SYNQ\lib\Video;
use PHPUnit\Framework\TestCase;

/**
 * @covers API
 */
final class VideoTest extends TestCase
{
    protected $client;

    protected function setUp()
    {
        $key = 'testkey';
        $host = 'testHost';
        $this->client = $this->getMockBuilder('GuzzleHttp\Client')
            ->setConstructorArgs(array(['base_uri' => $host]))
            ->setMethods(['request'])
            ->getMock();
    }

    public function testDetails()
    {
        $key = 'testkey';
        $host = 'testHost';

        $client->expects($this->once())
                 ->method('update')
                 ->with($this->equalTo('something'));

        $api = new Video($client);

        return true;
    }
}
