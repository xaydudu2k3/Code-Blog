<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PostComment extends Component
{
    public $post_id;
    public $comment = '';
    public $postComments;
    public $loadedComments = 4;
    public $totalCommentsCount;
    public $editingCommentId = null;
    public $editingCommentContent = '';

    public function mount($postId)
    {
        $this->post_id = $postId;
        $this->loadComments();
        $this->totalCommentsCount = Comment::where('post_id', $this->post_id)->count();
    }

    public function loadComments()
    {
        $this->postComments = Comment::join('users', 'users.id', '=', 'comments.user_id')
            ->join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
            ->where('post_id', $this->post_id)
            ->orderBy('comments.created_at', 'desc')
            ->take($this->loadedComments)
            ->get(['users.name', 'comments.*', 'user_profiles.image as avatar']);
    }

    public function loadMoreComments()
    {
        $this->loadedComments += 4;
        $this->loadComments();
    }

    public function leaveComment()
    {
        $this->validate([
            'comment' => 'required',
        ]);

        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $this->post_id,
            'comment' => $this->comment,
        ]);

        $this->comment = '';
        $this->loadComments();
        $this->totalCommentsCount++;
    }

    public function editComment($commentId)
    {
        $comment = Comment::find($commentId);
        if ($comment && $comment->user_id === Auth::id()) {
            $this->editingCommentId = $commentId;
            $this->editingCommentContent = $comment->comment;
        }
        $this->loadComments();
    }
    public function cancel()
    {
        $this->editingCommentId = null;
        $this->loadComments();
    }

    public function updateComment()
    {
        $this->validate([
            'editingCommentContent' => 'required',
        ]);

        $comment = Comment::find($this->editingCommentId);
        if ($comment && $comment->user_id === Auth::id()) {
            $comment->update([
                'comment' => $this->editingCommentContent,
                'updated_at' => now(),
            ]);
        }

        $this->editingCommentId = null;
        $this->editingCommentContent = '';
        $this->loadComments();
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::find($commentId);
        if ($comment && $comment->user_id === Auth::id()) {
            $comment->delete();
        }

        $this->loadComments();
        $this->totalCommentsCount--;
    }

    public function render()
    {
        return view('livewire.post-comment');
    }
}
