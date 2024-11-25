<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class AdminPostComponent extends Component
{

    public $search = '';

    public function mount()
    {
        
    }
    public function deletePost($postId)
    {
        Post::where('id', $postId)->delete();
        session()->flash('message', 'The post was successfully deleted!');
        $this->searchComment();
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
        $this->searchComment();
    }
    public function searchComment()
    {
        $posts = Post::where('content', 'like', '%' . $this->search . '%')
            ->get();
        $count = $posts->count();
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->searchComment();
    }
    public function render()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        $count = $posts->count();
        return view('livewire.admin-post-component', [
            'posts' => $posts,
            'count' => $count
        ]);
    }
}