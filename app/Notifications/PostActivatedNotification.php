<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PostActivatedNotification extends Notification
{
    use Queueable;

    private $post;

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "Your post '{$this->post->post_title}' has been activated by admin.",
            'post_title' => $this->post->post_title,
            'post_id' => $this->post->id,
            'act' => 1
        ];
    }
}
