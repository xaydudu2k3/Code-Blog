<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostViewers extends Model
{
    use HasFactory;

      protected $fillable = [
        'user_id',
        'post_id',
    ];
  // Thiết lập quan hệ với User
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  // Thiết lập quan hệ với Post
  public function post()
  {
    return $this->belongsTo(Post::class);
  }
}
