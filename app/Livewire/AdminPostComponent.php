<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class AdminPostComponent extends Component
{
    public $posts;
    public function mount()
    {
        // $this->posts = Post::with('user')->get();
        $this->posts = Post::all();
    }
    public function deletePost($postId)
    {
        Post::where('id', $postId)->delete();
        session()->flash('message', 'The post was successfully deleted!');
        return $this->redirect('/admin/posts', navigate: true);
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

        return $this->redirect('/admin/posts', navigate: true);
    }
    public function render()
    {
        return view('livewire.admin-post-component', [
            'posts' => $this->posts,
        ]);
    }
}
