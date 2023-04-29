<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewComment implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comment;
    public $date;
    public $postOwnerId;
    public $postId;
    public $commentOwnerName;
    public $notifyId;
    public function __construct($data)
    {
        $this->comment = $data['comment'];
        $this->date = $data['date'];
        $this->postOwnerId = $data['postOwnerId'];
        $this->postId = $data['postId'];
        $this->commentOwnerName = $data['commentOwnerName'];
        $this->notifyId=$data['notifyId'];
    }

    public function broadcastOn()
    {
        return ['post-channel'];
    }

    public function broadcastAs()
    {
        return 'new-comment';
    }
}
