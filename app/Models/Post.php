<?php

namespace App\Models;

use App\Notifications\PostActivatedNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_title',
        'content',
        'user_id',
        'active',   // Thêm cột active
        'publish',  // Thêm cột publish
    ];
    protected $casts = [
        'active' => 'boolean',
        'publish' => 'datetime',
    ];

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function views()
    {
        return $this->hasMany(PostViewers::class);
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }
    protected static function booted()
    {
        static::updated(function ($post) {
            if ($post->isDirty('active') && $post->active) { // Kiểm tra nếu cột active được thay đổi thành true
                // Gửi thông báo tới người sở hữu bài viết
                $post->user->notify(new PostActivatedNotification($post));
            }
        });
    }
}
