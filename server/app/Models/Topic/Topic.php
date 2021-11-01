<?php

namespace App\Models\Topic;

use App\Models\Message\Message;
use App\Models\Subscriber\Subscriber;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
    ];

    public $incrementing = false;

    public function subscribers()
    {
        return $this->hasMany(Subscriber::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
