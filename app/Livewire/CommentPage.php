<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class CommentPage extends Component
{
  public $comment_data;
  public $search = '';
  public $count;
  
  public function mount()
  {
    // $this->comment_data = Comment::join('user', 'user.id', '=', 'comment.user_id')
    // ->join('post', 'post.id', '=', 'comment.post_id')
    // ->first(['user.name', 'post.title as post_title', 'comment.*']);
    $this->comment_data = Comment::with('post')->get();
    $this->count = $this->comment_data->count();

  }


  public function deleteComment($id)
  {
    Comment::where('id', $id)->delete();
    session()->flash('message', 'The comment was successfully deleted!');
    $this->searchComment();
  }
  public function searchComment()
  {
    $this->render();
  }
  public function clearSearch()
    {
        $this->search = '';
        $this->searchComment(); 
    }

  public function render()
  { 
    $this->count = $this->comment_data->count();
    $cmts = Comment::where('comment', 'like', '%' . $this->search . '%')->paginate(6);
    return view('livewire.comment-page', [
      'comments' => $cmts,
      'count' => "$this->count"
    ]);
  }
}
