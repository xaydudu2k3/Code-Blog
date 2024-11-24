<div>
    <!-- Form để gửi bình luận -->
    @if(auth()->check())
    <form wire:submit.prevent="leaveComment">
        <div class="mb-3">
            <textarea class="form-control" wire:model.defer="comment" placeholder="Viết bình luận..."></textarea>
            @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button class="btn btn-primary" type="submit">Publish</button>
    </form>
    @else
    <div class="mb-3">
        <textarea class="form-control" placeholder="Please login to comment..." disabled></textarea>
    </div>
    <button class="btn btn-primary" disabled>Publish</button>
    @endif

    <!-- Hiển thị danh sách bình luận -->
    @foreach($postComments as $comment)
    <div class="comment-item mt-4 d-flex align-items-start" wire:key="comment-{{ $comment->id }}">
        <div class="avata me-3">
            <img src="{{ asset('storage/images/' .$comment->avatar) }}" height="30px" width="30px" alt="" class="rounded-circle">
        </div>
        <div class="comment-content flex-grow-1">
            <div class="d-flex justify-content-between">
                <div>
                    <strong>{{ $comment->name }}</strong>
                    <p>{{ $comment->comment }}</p>
                    <small class="text-muted">
                        @if($comment->updated_at != $comment->created_at)
                        (Edited {{ $comment->updated_at->diffForHumans() }})
                        @else
                        {{ $comment->created_at->diffForHumans() }}
                        @endif
                    </small>
                </div>
                @if(auth()->check() && $comment->user_id === auth()->id())
                <div class="dropdown">
                    <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" wire:click="editComment({{ $comment->id }})">Edit</a></li>
                        <li><a class="dropdown-item text-danger" wire:click="deleteComment({{ $comment->id }})">Delete</a></li>
                    </ul>
                </div>
                @endif
            </div>
            @if(auth()->check() && $editingCommentId === $comment->id)
            <div>
                <textarea class="form-control" wire:model.defer="editingCommentContent"></textarea>
                <div class="mt-2">
                    <button class="btn btn-primary btn-sm" wire:click="updateComment">Save</button>
                    <button class="btn btn-secondary btn-sm" wire:click="cancel">Cancel</button>
                </div>
            </div>
            @endif
        </div>
    </div>
    <hr>
    @endforeach

    <!-- Nút "Xem thêm bình luận" -->
    @if($totalCommentsCount > count($postComments))
    <button class="btn btn-link" wire:click="loadMoreComments">Load more comments</button>
    @endif
</div>