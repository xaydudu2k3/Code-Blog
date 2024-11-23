<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header align-items-center justify-content-between">
            <h1 class="card-title">Danh sách comment</h1>
            <div class="d-flex align-items-center justify-content-between">
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
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">User</th>
                        <th class="text-center">Post</th>
                        <th class="text-center">Comment</th>
                        <th class="text-center">Created at</th>
                        <th class="text-center" style="width:110px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $comment->user->name ?? 'N/A' }}</td>
                        <td>{{ $comment->post->post_title }}</td>
                        <td>{{ $comment->comment}}</td>
                        <td>{{ $comment->created_at }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                            @if ($comment->post)
                                <a href="/admin/view/post/{{ $comment->post->id }}" 
                                   class="btn btn-primary btn-sm">
                                    View
                                </a>
                            @endif
                            <button class="btn btn-danger btn-sm mx-1" wire:click="deleteComment({{ $comment->id }})">Delete</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->