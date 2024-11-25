<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PostCommentedNotification extends Notification
{
    use Queueable;

    private $user;
    private $post;
    private $comment;

    public function __construct($user, $post, $comment)
    {
        $this->user = $user;
        $this->post = $post;
        $this->comment = $comment;
    }

    public function via($notifiable)
    {
        return ['database']; // Gửi thông báo qua cơ sở dữ liệu
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "{$this->user->name} commented on your post: '{$this->comment->comment}'",
            'user_name' => $this->user->name,
            'user_id' => $this->user->id,
            'post_title' => $this->post->post_title,
            'post_id' => $this->post->id,
            'comment' => $this->comment->comment,
            'comment_id' => $this->comment->id,
        ];
    }
}
