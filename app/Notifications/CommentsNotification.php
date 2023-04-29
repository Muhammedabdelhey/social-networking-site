<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentsNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $postId;
    private $commentOwnerName;
    private $comment;
    private $date;
    public function __construct($data)
    {
        $this->postId = $data['postId'];
        $this->commentOwnerName = $data['commentOwnerName'];
        $this->comment = $data['comment'];
        $this->date = $data['date'];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'postId' => $this->postId,
            'commentOwnerName' => $this->commentOwnerName,
            'comment' => $this->comment,
            'date' => $this->date,
        ];
    }
}
