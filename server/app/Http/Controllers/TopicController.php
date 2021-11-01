<?php

namespace App\Http\Controllers;

use App\Exceptions\BroadcastFailedException;
use App\Exceptions\DuplicateSubscriptionAttemptException;
use App\Exceptions\ModelNotFoundException;
use App\Exceptions\SubscriptionFailedException;
use App\Services\TopicService;
use Illuminate\Http\Request;
use PDO;

class TopicController extends Controller
{
    private $topicService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TopicService $topicService)
    {
        //
        $this->topicService = $topicService;
    }

    //

    public function store(Request $request)
    {
        $this->validate($request, [
            "id" => "string|required"
        ]);

        return response()->json($this->topicService->store($request->all()), 201);
    }

    public function subscribe(Request $request, string $topic)
    {
        $this->validate($request, [
            "url" => "required|url"
        ]);

        try {
            return response()->json($this->topicService->subscribe($topic, $request->url));
        } catch (DuplicateSubscriptionAttemptException $e) {
            return response()->json(["error" => true, "message" => "Subscription failed", "reason" => $e->getMessage()], 419);
        } catch (ModelNotFoundException $e) {
            return response()->json(["error" => true, "message" => "Unknown topic", "reason" => null], 404);
        } catch (SubscriptionFailedException $e) {
            return response()->json(["error" => true, "message" => "Subscription failed", "reason" => $e->getMessage()], 500);
        } catch (\Throwable $th) {
            return response()->json(["error" => true, "message" => "Server error", "reason" => null], 500);
        }
    }

    public function broadcast(Request $request, string $topic)
    {
        try {
            return response()->json($this->topicService->publishMessage($topic, $request->all()));
        } catch (ModelNotFoundException $e) {
            return response()->json(["error" => true, "message" => "Unknown topic", "reason" => null], 404);
        } catch (BroadcastFailedException $e) {
            return response()->json(["error" => true, "message" => "Failed to publish message", "reason" => $e->getMessage()], 500);
        } catch (\Throwable $e) {
            return response()->json(["error" => true, "message" => "Server error", "reason" => null], 500);
        }
    }
}
