<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\PostViewers;
use App\Models\Tag;
use Livewire\Component;

class ViewPostComponent extends Component
{
    public $posts;
    public $tag_name;
    public function mount($tag_id)
    {
        $this->posts = Post::join('users', 'users.id', '=', 'posts.user_id')->orderBy('created_at', 'desc')->get(['users.name', 'users.id as followedId', 'posts.*']); //this will fetch all posts and order them desc by date created also join the 
        //user table to see each user with their posts..
        if($tag_id){
            $this->tag_name = Tag::find($tag_id)->name;
            $this->posts = Post::whereHas('tags', function ($query) use ($tag_id) {
                $query->where('tags.id', $tag_id);
            })
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->orderBy('posts.created_at', 'desc')
                ->get(['users.name', 'users.id as followedId', 'posts.*']);
        }
    }
    public function addViewers($postId){
        // here we add to post viewers table.. lets create a model and its migration..
        // now let's add post viewers
        $addviewer = new PostViewers;
        $addviewer->user_id = auth()->user()->id;
        $addviewer->post_id = $postId;
        $addviewer->save();
    }
    public function render()
    {
        return view('livewire.view-post-component', [
            'tag_name' => $this->tag_name
        ]);
    }
}
