<?php

namespace App\Models\Subscriber;

use App\Models\DataTransferObject;

class SubscriberDTO extends DataTransferObject {
    public $topic_id;
    public $url;

    public function toArray() : array
    {
        return [
            "topic_id" => $this->topic_id,
            "url" => $this->url
        ];
    }
}
