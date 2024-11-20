<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\PostViewers;
use App\Models\Tag;
use Livewire\Component;

class ViewPostComponent extends Component
{

    public $posts;
    public $sortOption = 'latest';
    public $tag_id;
    public function mount($tag_id)
    {

        //this will fetch all posts and order them desc by date created also join the 
        //user table to see each user with their posts..
        $this->tag_id = $tag_id;
    }
    public function updateSorting()
    {
        // Không cần làm gì thêm, Livewire sẽ tự động gọi lại phương thức render()
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
    // public function render()
    // {
    //     $tag_name = Tag::find($this->tag_id)->name ?? "";
    //     $post_pag = Post::join('users', 'users.id', '=', 'posts.user_id')
    //         ->orderBy('posts.created_at', 'desc') // Lưu ý đặt prefix rõ ràng cho các cột
    //         ->select('users.name', 'users.id as followedId', 'posts.*')->paginate(6);
    //     if($this->tag_id) {
    //         $post_pag = Post::join('users', 'users.id', '=', 'posts.user_id')
    //             ->whereHas('tags', function ($query)  {
    //                 $query->where('tags.id', $this->tag_id);
    //             })
    //             ->orderBy('posts.created_at', 'desc')
    //             ->select('users.name', 'users.id as followedId', 'posts.*')
    //             ->paginate(6);
    //     }
    //     return view('livewire.view-post-component', [
    //         'pposts' => $post_pag,
    //         'tag_name' => $tag_name
    //     ]);
    // }
    public function render()
    {
        $tag_name = Tag::find($this->tag_id)->name ?? "";

        $post_pag = Post::join('users', 'users.id', '=', 'posts.user_id')
            ->select('users.name', 'users.id as followedId', 'posts.*')->where('posts.active', 1);

        if ($this->tag_id) {
            $post_pag = $post_pag->whereHas('tags', function ($query) {
                $query->where('tags.id', $this->tag_id);
            });
        }

        if ($this->sortOption === 'latest') {
            $post_pag = $post_pag->orderBy('posts.created_at', 'desc');
        } elseif ($this->sortOption === 'oldest') {
            $post_pag = $post_pag->orderBy('posts.created_at', 'asc');
        } elseif ($this->sortOption === 'most_viewed') {
            $post_pag = $post_pag->withCount('views')->orderBy('views_count', 'desc');
        }

        $post_pag = $post_pag->paginate(6);

        return view('livewire.view-post-component', [
            'pposts' => $post_pag,
            'tag_name' => $tag_name,
        ]);
    }

}