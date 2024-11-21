<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;

class CommentPage extends Component
{
  public $comment_data;
  public $search = '';
  
  public function mount()
  {
    // $this->comment_data = Comment::join('user', 'user.id', '=', 'comment.user_id')
    // ->join('post', 'post.id', '=', 'comment.post_id')
    // ->first(['user.name', 'post.title as post_title', 'comment.*']);
    $this->comment_data = Comment::with('post')->get();
  }


  public function deleteComment($id)
  {
    Comment::where('id', $id)->delete();
    session()->flash('message', 'The comment was successfully deleted!');
    return $this->redirect('/admin/comment', navigate: true);
  }
  public function searchComment()
  {
    // Tìm kiếm các Comment theo giá trị search
    $this->comment_data = Comment::where('comment', 'like', '%' . $this->search . '%')->get();
  }

  public function render()
  {
    return view('livewire.comment-page', [
      'comments' => $this->comment_data
    ]);
  }
}
