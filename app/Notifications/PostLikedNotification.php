<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostLikedNotification extends Notification
{
    use Queueable;

    private $user;
    private $post;

    public function __construct($user, $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "{$this->user->name} đã thích bài viết của bạn: {$this->post->post_title}",
            'user_name' => $this->user->name,
            'user_id' => $this->user->id,
            'post_title' => $this->post->post_title,
            'post_id' => $this->post->id,
        ];
    }
}
