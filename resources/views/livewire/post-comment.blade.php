<div>
    <!-- Form để gửi bình luận -->
    <form wire:submit.prevent="leaveComment">
        <div class="mb-3">
            <textarea class="form-control" wire:model.defer="comment" placeholder="Viết bình luận..."></textarea>
            @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button class="btn btn-primary" type="submit">Publish</button>
    </form>

    <!-- Hiển thị danh sách bình luận -->
    @foreach ($postComments as $item)
        <div class="row my-3">
            <div class="col-1">
                <livewire:profile-image :userId="$item->user_id" />
            </div>
            <div class="col-11">
                <span class="fw-bold">{{ $item->name }}:</span>
                <p class="mb-1">{{ $item->comment }}</p>
                <span class="text-muted small">{{ $item->created_at->diffForHumans() }}</span>
            </div>
        </div>
        <hr>
    @endforeach

    <!-- Nút "Xem thêm bình luận" -->
    @if ($totalCommentsCount > $loadedComments)
        <button class="btn btn-outline-primary btn-sm mt-3 float-end" wire:click="loadMoreComments">
            More comments
        </button>
    @endif
</div>
