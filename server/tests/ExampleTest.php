<?php

use App\Models\Topic\Topic;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class TopicTest extends TestCase
{
    /**
     * Test the ability to subscribe to a topic
     *
     * @return void
     */
    public function test_a_topic_can_be_subscribed_to()
    {
        $topic = Topic::first();

        $this->post("/subscribe/$topic->id");
        $this->assertResponseStatus(422);
    }
}
