<?php
declare(strict_types=1);

namespace SYNQ\lib;

/**
* The synq api SDK
*/
class API
{
    public $key;
    public $host;

    public function __construct(string $key, string $host) : void
    {
        $this->key = $key;
        $this->host = $host;
    }
}
