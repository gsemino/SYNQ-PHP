<?php
require('./vendor/autoload.php');

use SYNQ\lib\API;
/*
*   Simple integraion tests.
*   You have to set SYNQ_API_KEY as env variable.
*/
class SynqIntegrationTests {
    private $video_id;
    private $userKey;
    private $userVal;
    private $userValChanged;
    private $api;

    public function __construct()
    {
        $this->userKey = 'test';
        $this->userVal = 'val';
        $this->userValChanged = 'notval';
        $this->api_key = getenv('SYNQ_API_KEY');

        if(!isset($this->api_key)) {
            throw new Exception("Set api key as env. var.");
        }
        $this->api = new API($this->api_key, 'https://api.synq.fm/v1/');
    }

    public function testAll()
    {
        try {
            $this->create();
            $this->details();
            $this->querySimple();
            $this->update();
            $this->upload();
            $this->uploader();
        } catch (Exception $e) {
            print_r($e);
        }
    }

    private function create()
    {
        $res = $this->api->video->create(array($this->userKey => $this->userVal));
        echo "
            Create:
        ";
        if ($res->getStatusCode() === 200) {
            echo "
                Returned 200
            ";
        } else {
            throw new Exception("Create did not return 200");
        }

        $videoObject = json_decode($res->getBody());
        if ($videoObject->state === 'created' &&
        $videoObject->userdata->test === $this->userVal) {
            echo "
                Has state created and correct userdata
            ";
            $this->video_id = $videoObject->video_id;
        } else {
            echo $res->getBody();
            throw new Exception("Create got incorrect video object");
        }
    }

    private function details()
    {
        $res = $this->api->video->details($this->video_id);
        echo "
            DETAILS:
        ";
        if ($res->getStatusCode() === 200) {
            echo "
                Returned 200
            ";
        } else {
            throw new Exception("DETAILS did not return 200");
        }

        $videoObject = json_decode($res->getBody());
        if ($videoObject->state === 'created' &&
        $videoObject->userdata->test === $this->userVal) {
            echo "
                Has state created and correct userdata
            ";
        } else {
            echo $res->getBody();
            throw new Exception("Create got incorrect video object");
        }
    }

    private function querySimple()
    {
        $res = $this->api->video->querySimple('userdata.test', $this->userVal);
        echo "
            QUERY SIMPLE:
        ";
        if ($res->getStatusCode() === 200) {
            echo "
                Returned 200
            ";
        } else {
            throw new Exception("Create did not return 200");
        }

        $videoObject = json_decode($res->getBody());
        if (count($videoObject) > 0 &&
            $videoObject[0]->userdata->test === $this->userVal) {
            echo "
                Found object
            ";
        } else {
            echo $res->getBody();
            throw new Exception("Create got incorrect video object");
        }
    }

    private function update()
    {
        $updateSource = 'video.userdata.test = "'.$this->userValChanged.'"';
        $res = $this->api->video->update($this->video_id, $updateSource);
        echo "
            UPDATE:
        ";
        if ($res->getStatusCode() === 200) {
            echo "
                Returned 200
            ";
        } else {
            throw new Exception("Create did not return 200");
        }

        $videoObject = json_decode($res->getBody());

        if ($videoObject->state === 'created' &&
        $videoObject->userdata->test === $this->userValChanged) {
            echo "
                Has state created and new changed userdata
            ";
        } else {
            echo $res->getBody();
            throw new Exception("Create got incorrect video object");
        }
    }

    private function upload()
    {
        $res = $this->api->video->upload($this->video_id);
        echo "
            UPLOAD:
        ";
        if ($res->getStatusCode() === 200) {
            echo "
                Returned 200
            ";
        } else {
            throw new Exception("Create did not return 200");
        }

        $awsDetails = json_decode($res->getBody());
        if ($awsDetails->action === 'https://synqfm.s3.amazonaws.com') {
            echo "
                Had 'https://synqfm.s3.amazonaws.com' as action.
            ";
        } else {
            echo $res->getBody();
            throw new Exception("Create got incorrect video object");
        }
    }

    private function uploader()
    {
        $res = $this->api->video->uploader($this->video_id);
        echo "
            UPLOADER:
        ";
        if ($res->getStatusCode() === 200) {
            echo "
                Returned 200
            ";
        } else {
            throw new Exception("Create did not return 200");
        }

        $uploaderDetails = json_decode($res->getBody());
        if (strpos($uploaderDetails->uploader_url, 'https://synq.fm/uploader/') !== false) {
            echo "
                Contained 'https://synq.fm/uploader/'
            ";
        } else {
            echo $res->getBody();
            throw new Exception("Create got incorrect video object");
        }
    }
}

$test = new SynqIntegrationTests();
$test->testAll();
