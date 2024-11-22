<div class="row">
    <div class="col-12">
        @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <h3 class="mb-4">Comments by {{ $name }}: {{ $count }}</h3>
        <div class="search-bar">
            <form class="search-form d-flex align-items-center" wire:submit.prevent="searchComment">
                <div class="position-relative">
                    <input 
                        type="text" 
                        name="search" 
                        wire:model="search" 
                        placeholder="Search" 
                        title="Enter search keyword" 
                        class="form-control"
                    >
                    @if ($search)
                        <button 
                            type="button" 
                            class="btn btn-clear position-absolute end-0 top-0" 
                            style="border: none; background: transparent; padding: 0.5rem;" 
                            wire:click="clearSearch">
                            ✖
                        </button>
                    @endif
                </div>
                <button type="submit" title="Search" class="btn btn-primary ms-2">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Post Title</th>
                    <th>Content</th>
                    <th>Comment Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                <tr>
                    <td>{{ $comment->post->post_title ?? 'Post Deleted' }}</td>
                    <td>{{ $comment->comment ?? 'Post Deleted' }}</td>
                    <td>{{ $comment->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" wire:click="deleteComment({{ $comment->id }})">
                            Delete
                        </button>
                        @if ($comment->post)
                        <a href="/admin/view/post/{{ $comment->post->id }}"
                            class="btn btn-primary btn-sm">
                            View Post
                        </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if ($comments->isEmpty())
        <p class="text-muted">No comments found for this user.</p>
        @endif
        <button onclick="history.back()" class="btn btn-secondary ms-3">Back</button>
    </div>
</div>