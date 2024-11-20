<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Comment;
use App\Models\Post;

use Livewire\Component;

class UserComment extends Component
{
    public $cmts;
    public $name;
    public $count;

    public function mount($userId)
    {
      
        $this->cmts = Comment::where('user_id', $userId)
            ->with('post') 
            ->orderByDesc('created_at')
            ->get();
        $this->name = User::find($userId)->name;
        $this->count = $this->cmts->count();
    }

    public function deleteComment($commentId)
    {

        $comment = Comment::find($commentId);
        if ($comment) {
            $comment->delete();
            session()->flash('message', 'Comment deleted successfully.');
            $this->cmts = $this->cmts->filter(fn ($c) => $c->id !== $commentId);
        } else {
            session()->flash('error', 'Comment not found.');
        }
        $this->count = $this->cmts->count();
    }

    public function render()
    {
        return view('livewire.user-comment', [
            'comments' => $this->cmts,
            'name' => $this->name,
            'count' =>"$this->count"
        ]);
    }
}
