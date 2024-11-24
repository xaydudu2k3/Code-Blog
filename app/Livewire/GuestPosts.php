<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class GuestPosts extends Component
{
    public $user_id;
    public $name;
    public $search = '';
    public $count;
    public $role;
    public function mount($user_id)
    {
        $this->user_id = $user_id;
        $this->name = User::find($user_id)->name;
        $this->role = auth()->user()->role;
    }
    public function searchTag()
    {
        $this->render();
    }
    public function deletePost($postId)
    {
        Post::where('id', $postId)->delete();
        session()->flash('message', 'The post was successfully deleted!');
        return redirect(request()->header('Referer'));
    }
    public function Publish($postId)
    {
        $post = Post::find($postId);
        if ($post) {
            $post->active = !$post->active;
            if ($post->active) {
                $post->publish = now();
            }
            $post->save();
            $message = $post->active
                ? 'The post is published!'
                : 'The post is hidden!';
            session()->flash('message', $message);
        } else {
            session()->flash('error', 'Post not found!');
        }
    }
    public function clearSearch()
    {
        $this->search = '';
        $this->searchTag(); 
    }
    public function render()
    {
        $posts = Post::join('users', 'users.id', '=', 'posts.user_id')
            ->where('user_id', $this->user_id)
            ->where('posts.post_title', 'like', '%' . $this->search . '%')
            ->orderBy('posts.created_at', 'desc')
            ->paginate(6, ['posts.*']);
            $this->count = $posts->count();
        return view('livewire.guest-posts', [
            'posts' => $posts,
            'name' => $this->name,
            'count' => "$this->count"
        ]);
    }
}
