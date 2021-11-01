<?php

namespace App\Models\Message;

use App\Models\Subscriber\Subscriber;
use App\Models\Topic\Topic;
use Illuminate\Database\Eloquent\Model;

class Message extends Model{

    protected $fillable = [
        "topic_id",
        "data"
    ];


    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function subscribers()
    {
        return $this->belongsToMany(Subscriber::class)->withPivot(["tries", "status_code", "created_at"]);
    }
}
