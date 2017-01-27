<?php
declare(strict_types=1);
namespace SYNQ\lib;

use SYNQ\lib\Endpoint;

class Video extends Endpoint
{
    public function details(string $video)
    {
        return $this->request('video/details', ['video_id' => $video]);
    }

    public function create(array $userdata = [])
    {
        return $this->request('video/create', array('userdata' => json_encode($userdata)));
    }

    public function query(string $filter)
    {
        return $this->request('video/query', ['filter' => $filter]);
    }

    public function querySimple(string $key, string $value)
    {
        return $this->query('if (video.'.$key.' == "'.$value.'") {return video;}');
    }

    public function update(string $video, string $source)
    {
        return $this->request('video/update', ['source' => $source, 'video_id' => $video]);
    }

    public function upload(string $video)
    {
        return $this->request('video/upload', ['video_id' => $video]);
    }

    public function uploader(string $video, string $timeout = '2 hours')
    {
        return $this->request('video/uploader', ['video_id' => $video, 'timeout' => $timeout]);
    }
}
