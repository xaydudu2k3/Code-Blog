<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  protected $fillable = ['name'];
  // Define the many-to-many relationship with Post
  public function posts()
  {
    return $this->belongsToMany(Post::class);
  }

  public function tags()
  {
    return $this->belongsToMany(Tag::class);
  }
}