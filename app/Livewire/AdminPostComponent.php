<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class AdminPostComponent extends Component
{
    public $posts;
    public function mount() {
        // $this->posts = Post::with('user')->get();
        $this->posts = Post::all();
    }
    public function deletePostbyAdmin($postId)
    {
        Post::where('id', $postId)->delete();
    session()->flash('message', 'The post was successfully deleted!');
    return $this->redirect('/admin/posts',navigate: true);
    }
    public function hehe($postId) {
        dd($postId);
    }
    public function render()
    {
        return view('livewire.admin-post-component', [
            'posts' => $this->posts,
        ]);
    }
}
