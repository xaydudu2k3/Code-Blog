<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;

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
    // Tìm kiếm các Comment theo giá trị search
    $this->comment_data = Comment::where('comment', 'like', '%' . $this->search . '%')->get();
    $this->count = $this->comment_data->count();
  }
  public function clearSearch()
    {
        $this->search = '';
        $this->searchComment(); 
    }

  public function render()
  {
    return view('livewire.comment-page', [
      'comments' => $this->comment_data,
      'count' => "$this->count"
    ]);
  }
}
