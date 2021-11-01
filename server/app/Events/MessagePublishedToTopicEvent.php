<?php

namespace App\Events;

use App\Models\Message\Message;

class MessagePublishedToTopicEvent extends Event
{
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct(Message $message)
    {
        //
        $this->message = $message;
    }
}
