<?php
declare(strict_types=1);
namespace SYNQ\lib;

use GuzzleHttp\Client;

/**
 * Abstract class that is made
 */
abstract class Endpoint
{
    private $client;
    private $key;

    public function __construct(string $key, Client $client)
    {
        $this->key = $key;
        $this->client = $client;
    }

    public function request(string $uri, array $formData = [])
    {
        $formData['api_key'] = $this->key;
        return $client->request('POST', $uri, array('form_params' => $formData ));
    }
}
