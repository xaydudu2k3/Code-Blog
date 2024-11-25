<?php

namespace App\Models;

use App\Notifications\PostCommentedNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_id',
        'comment'
    ];
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class); 
    }
    protected static function booted()
    {
        static::created(function ($comment) {
            // Lấy bài viết và người dùng bình luận
            $post = $comment->post;
            $user = $comment->user;

            // Gửi thông báo đến chủ bài viết
            $post->user->notify(new PostCommentedNotification($user, $post, $comment));
        });
    }
}
