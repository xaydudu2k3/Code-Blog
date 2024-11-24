<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Follower;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class MyPosts extends Component
{
  public $my_posts_count;
  public $my_comments_count;
  public $my_followers_count; 
  public function mount()
  {
    $user_id = auth()->user()->id;
    $this->my_posts = Post::where('user_id', $user_id)->get();
    $this->my_posts_count = Post::where('user_id', $user_id)->count();
    $this->my_comments_count = Comment::where('user_id', $user_id)->count();
    $this->my_followers_count = Follower::where('followed_id', $user_id)->count();
  }

  public function deletePost($id){
    Post::where('id', $id)->delete();
    session()->flash('message', 'The post was successfully deleted!');
    return $this->redirect('/my/posts',navigate: true);
  }
  public function render()
  {
    $user_id = auth()->user()->id;
    $posts = Post::where('user_id', $user_id)->paginate(8);
    return view('livewire.my-posts', [
      'posts' => $posts,
      'post_count' => $this->my_posts_count,
      'comment_count' => $this->my_comments_count,
      'follower_count' => $this->my_followers_count
    ]);
  }
}
