<div class="card">
    <div class="card-header align-items-center justify-content-between">
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
    </div>
        <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-center">Post Title</th>
                    <th class="text-center">Content</th>
                    <th class="text-center">Comment Date</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                <tr class="text-center">
                    <td>{{ $comment->post->post_title ?? 'Post Deleted' }}</td>
                    <td>{{ $comment->comment ?? 'Post Deleted' }}</td>
                    <td>{{ $comment->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            @if ($comment->post)
                            <a href="{{ $role ? '/admin/view/post' : '/view/post' }}/{{ $comment->post->id }}"
                                class="btn btn-primary btn-sm mx-1">
                                View Post
                            </a>
                            @endif
                            <button class="btn btn-danger btn-sm" wire:click="deleteComment({{ $comment->id }})">
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $comments->links() }}
        </div>
        @if ($comments->isEmpty())
        <p class="text-muted">No comments found for this user.</p>
        @endif
        <button onclick="history.back()" class="btn btn-secondary ms-3">Back</button>
    </div>

</div>

