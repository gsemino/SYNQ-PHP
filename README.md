# synq-php-client

Composer php client library simplifying use of the SYNQ.fm API in a PHP environment.

The library provides functions mirroring the endpoints in the api, and some simplifying functions.

It makes use of [GUZZLE](http://docs.guzzlephp.org/) to make requests.

## Get started

__Composer:__

Use composer to install:

https://getcomposer.org/

```php
"require": {
        "synq/php-client": "1.0.*"
}
```

## Usage

```php
use SYNQ\lib\API;
```

#### Basic examples for all endpoints

All endpoints return results in the form of objects as specified in PSR-7
from the underlying request library [guzzlephp](http://docs.guzzlephp.org/en/latest/quickstart.html#using-responses).


Basic example

```php
// Init the library by setting the url and api key
$api = new API(getenv('SYNQ_API_KEY'), 'https://api.synq.fm/v1/');
echo $result->getStatusCode();
echo $result->getBody();


// Create a new video object
$result = $api->video->create($userdata);
echo $result->getStatusCode();
echo $result->getBody();

// Get a video object
$result = $api->video->details($videoId);
echo $result->getStatusCode();
echo $result->getBody();

// Query video objects by equality to a single key value pair in the metadata
$result = $api->video->querySimple($key, $value);
echo $result->getStatusCode();
echo $result->getBody();

// Query videoobjects by metadata fields by providing filtering code
// ex: 'if (video.views > 3000) { return video }' returns all videos where views > 300
$result = $api->video->query($source);
echo $result->getStatusCode();
echo $result->getBody();

// Update the metadata of a video object by providing code that handles the update
// eks: 'video.userdata.baz = "bar"'
$result = $api->video->update($videoId, $source);
echo $result->getStatusCode();
echo $result->getBody();

// Get upload parameters to Amazon S3.
$result = $api->video->upload($videoId);
echo $result->getStatusCode();
echo $result->getBody();

// Get embeddable uploader
$result = $api->video->uploader($videoId);
echo $result->getStatusCode();
echo $result->getBody();
```

## Error handling

Will throw exceptions from underlying request library(guzzlephp) according to PSR-7 standard.

http://docs.guzzlephp.org/en/latest/quickstart.html#exceptions


## Test

Integration tests are included for all api methods.

Set your api key as "SYNQ_API_KEY" env. variable

Then run `php -f integrationTest/SynqIntegrationTests.php` from project root folder.
