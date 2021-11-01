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

        $this->post("/subscribe/$topic->id", ["url" => "http://localhost:9000/main"]);
        $this->assertResponseOk();
    }

    /**
     * Test the ability to subscribe to a topic
     *
     * @return void
     */
    public function test_a_message_can_be_broadcast_to_a_topic()
    {

    }

}
