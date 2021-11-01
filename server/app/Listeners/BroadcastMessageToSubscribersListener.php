<?php

namespace App\Listeners;

use App\Events\MessagePublishedToTopicEvent;
use App\Jobs\SendMessage;
use Illuminate\Contracts\Queue\ShouldQueue;

class BroadcastMessageToSubscribersListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\MessagePublishedToTopicEvent  $event
     * @return void
     */
    public function handle(MessagePublishedToTopicEvent $event)
    {
        //
        $message = $event->message;
        $message->load("topic", "topic.subscribers");

        foreach($message->topic->subscribers as $subscriber){
            dispatch(new SendMessage($message, $subscriber));
        }
    }
}
