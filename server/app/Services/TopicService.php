<?php


namespace App\Services;

use App\Events\MessagePublishedToTopicEvent;
use App\Exceptions\BroadcastFailedException;
use App\Exceptions\DuplicateSubscriptionAttemptException;
use App\Exceptions\SubscriptionFailedException;
use App\Models\Topic\TopicDTO;
use App\Models\Topic\Topic;
use App\Repositories\TopicRepository;

class TopicService
{

    private $topicRepository;

    public function __construct(TopicRepository $topicRepository)
    {
        $this->topicRepository = $topicRepository;
    }

    public function store(array $data): Topic
    {
        return $this->topicRepository->store(new TopicDTO($data));
    }

    public function subscribe(string $topic, string $url): array
    {
        try {
            $topic = $this->topicRepository->find($topic);

            if($topic->subscribers()->where("url", $url)->count() > 0){
                throw new DuplicateSubscriptionAttemptException("Duplicate URL subscription attempt");
            }

            if ($topic->subscribers()->create(["url" => $url])) {
                return [
                    "url" => $url,
                    "topic" => $topic->id
                ];
            }
        } catch (\Throwable $th) {
            throw (new SubscriptionFailedException("Failed to create subscription to topic with reason : " . $th->getMessage()));
        }

        throw (new SubscriptionFailedException("Failed to create subscription to topic"));
    }

    public function publishMessage(string $topic, array $data): array
    {
        try {
            $topic = $this->topicRepository->find($topic);
            $message = $topic->messages()->create([
                "data" => json_encode($data)
            ]);

            event(new MessagePublishedToTopicEvent($message));

            return [
                "topic" => $topic->id,
                "data" => $data,
                "message" => "Message broadcast successful"
            ];
        } catch (\Throwable $th) {
            throw (new BroadcastFailedException("Failed to create subscription to topic with reason : " . $th->getMessage()));
        }
    }
}
