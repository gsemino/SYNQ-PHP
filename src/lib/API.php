<?php
declare(strict_types=1);
namespace SYNQ\lib;

use SYNQ\lib\Video;
use GuzzleHttp\Client;

/**
* The synq api SDK
*/
class API
{
    private $host;
    public $video;

    public function __construct(string $key, string $host)
    {
        $this->host = $host;
        $this->video = new Video(new Client(['base_uri' => $host]));
    }
}
