<?php

namespace App\Models;

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
}
