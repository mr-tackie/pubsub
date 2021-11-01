<?php

namespace App\Jobs;

use App\Models\Message\Message;
use App\Models\Subscriber\Subscriber;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;

class SendMessage extends Job
{
    private $subscriber;
    private $message;
    private $client;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Message $message, Subscriber $subscriber)
    {
        //
        $this->message = $message;
        $this->subscriber = $subscriber;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $tries = 1;
        $status = 0;

        while ($tries <= 3){
            try {
                $client = new Client();
                $response = $client->post($this->subscriber->url, [
                    "headers" => [
                        "Content-Type" => "application/json"
                    ],
                    "json" => json_decode($this->message->data, true),
                ]);
                $status = $response->getStatusCode();
                break;
            } catch (ServerException $e){
                if($tries == 3 && $e->hasResponse()){
                    $status = $e->getResponse()->getStatusCode();
                }else{
                    $tries++;
                }
            } catch (RequestException $e){
                if($tries == 3 && $e->hasResponse()){
                    $status = $e->getResponse()->getStatusCode();
                }else{
                    $tries++;
                }
            }
            catch(ConnectException $e) {
                if($tries == 3){
                    $status = 900;
                }
            }catch (\Throwable $th) {
                if($tries == 3){
                    throw $th;
                }else{
                    $tries++;
                }
            }
        }

        $this->message->subscribers()->attach($this->subscriber->id, [
            "status_code" => $status,
            "tries" => $tries
        ]);
    }
}
