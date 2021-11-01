<?php

namespace App\Models\Topic;
use App\Models\DataTransferObject;

class TopicDTO extends DataTransferObject{
    public $id;

    public function toArray() : array
    {
        return [
            "id" => $this->id
        ];
    }
}
