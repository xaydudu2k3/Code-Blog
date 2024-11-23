<?php

namespace App\Livewire;

use App\Models\Like;
use App\Notifications\PostLikedNotification;
use Livewire\Component;

class LikeComponent extends Component
{
    public $post_id;
    public $isLiked;

    public function mount($postId)
    {
        $this->post_id = $postId;
        if (auth()->check()) {
            // check if likes table then assign isLiked corresponding value..
            $checker = Like::where([['user_id', auth()->user()->id], ['post_id', $this->post_id]])->first();
            $this->isLiked = $checker == null ? false : true;
        }
    }

    public function likeUnlike()
    {
        if ($this->isLiked == false) {
            $this->isLiked = true;

            $likePost = new Like;
            $likePost->user_id = auth()->user()->id;
            $likePost->post_id = $this->post_id;
            $likePost->save();

            // Gửi thông báo
            $post = $likePost->post;
            $post->user->notify(new PostLikedNotification(auth()->user(), $post));
        } else {
            $this->isLiked = false;
            Like::where([['user_id', auth()->user()->id], ['post_id', $this->post_id]])->delete();
        }
    }
    public function render()
    {
        return view('livewire.like-component', [
            'likesCount' => Like::where('post_id', $this->post_id)->count()
        ]);
    }
}
