<?php

namespace App\Repositories;

use App\Exceptions\ModelNotFoundException;
use App\Models\Topic\TopicDTO;
use App\Models\Topic\Topic;

class TopicRepository {

    private $topic;

    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
    }


    public function find( string $id) : Topic
    {
        $topic = $this->topic->where("id", $id)->first();

        if(is_null($topic)){
            throw new ModelNotFoundException("No results were found for model Topic");
        }

        return $topic;
    }

    public function store( TopicDTO $data ) : Topic
    {
        return $this->topic->create($data->toArray());
    }
}
