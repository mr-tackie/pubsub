<?php

namespace App\Models\Subscriber;

use App\Models\Topic\Topic;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url', 'topic_id',
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
