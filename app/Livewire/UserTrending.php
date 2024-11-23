<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\PostViewers;
use App\Models\Tag;
use Illuminate\Support\Carbon;
use Livewire\Component;

class UserTrending extends Component
{
    public $posts;
    public $tag_id;
    public function mount($tag_id)
    {
        //this will fetch all posts and order them desc by date created also join the 
        //user table to see each user with their posts..
        $this->tag_id = $tag_id;
    }
    public function addViewers($postId)
    {
        // here we add to post viewers table.. lets create a model and its migration..
        // now let's add post viewers
        $addviewer = new PostViewers;
        $addviewer->user_id = auth()->user()->id;
        $addviewer->post_id = $postId;
        $addviewer->save();
    }
    public function render()
    {
        $tag_name = Tag::find($this->tag_id)->name ?? "";

        $post_pag = Post::join('users', 'users.id', '=', 'posts.user_id')
            ->leftJoin('post_viewers', 'post_viewers.post_id', '=', 'posts.id')
            ->select(
                'users.name',
                'users.id as followedId',
                'posts.*',
                \DB::raw('COUNT(post_viewers.id) as view_count')
            )
            ->where('posts.active', 1)
            ->where('post_viewers.created_at', '>=', Carbon::now()->subMonth())
            ->groupBy('posts.id', 'users.name', 'users.id', 'posts.post_title', 'posts.content', 'posts.photo', 'posts.user_id', 'posts.active', 'posts.publish', 'posts.created_at', 'posts.updated_at')
            ->orderByDesc('view_count');

        if ($this->tag_id) {
            $post_pag = $post_pag->whereHas('tags', function ($query) {
                $query->where('tags.id', $this->tag_id);
            });
        }
        $post_pag = $post_pag->paginate(6);

        return view('livewire.user-trending', [
            'pposts' => $post_pag,
            'tag_name' => $tag_name,
        ]);
    }
}
