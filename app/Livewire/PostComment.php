<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;

class PostComment extends Component
{
    public $post_id; // ID của bài viết
    public $comment = ''; // Nội dung bình luận người dùng nhập
    public $postComments; // Danh sách bình luận của bài viết
    public $loadedComments = 4; // Số lượng bình luận tải mỗi lần
    public $totalCommentsCount; // Tổng số lượng bình luận

    public function mount($postId)
    {
        $this->post_id = $postId;
        $this->loadComments(); // Gọi phương thức tải bình luận ban đầu
        $this->totalCommentsCount = Comment::where('post_id', $this->post_id)->count();
    }

    public function loadComments()
    {
        // Lấy danh sách bình luận có giới hạn
        $this->postComments = Comment::join('users', 'users.id', '=', 'comments.user_id')
            ->join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
            ->where('post_id', $this->post_id)
            ->orderBy('comments.created_at', 'desc')
            ->take($this->loadedComments)
            ->get(['users.name', 'comments.*', 'user_profiles.image']);
    }

    public function loadMoreComments()
    {
        $this->loadedComments += 4; // Tăng số bình luận được tải
        $this->loadComments(); // Tải thêm bình luận
    }

    public function leaveComment()
    {
        $this->validate([
            'comment' => 'required|min:1',
        ]);

        // Lưu bình luận mới
        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $this->post_id,
            'comment' => $this->comment,
        ]);

        $this->comment = ''; // Reset ô nhập
        $this->loadComments(); // Cập nhật lại danh sách bình luận
        $this->totalCommentsCount++; // Tăng tổng số lượng bình luận
    }

    public function render()
    {
        return view('livewire.post-comment');
    }
}
