<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Follower extends Model
{
    use HasFactory;
    // Quan hệ để lấy thông tin người theo dõi (follower)
    public function follower(): BelongsTo
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    // Quan hệ để lấy thông tin người được theo dõi (followed)
    public function followed(): BelongsTo
    {
        return $this->belongsTo(User::class, 'followed_id');
    }
}
