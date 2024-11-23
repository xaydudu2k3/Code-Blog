<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header align-items-center justify-content-between">
            <h1 class="card-title">List Posts by {{ $name }}: {{ $count }}</h1>
            <div class="d-flex align-items-center justify-content-between">
                <div class="search-bar">
                    <form class="search-form d-flex align-items-center" wire:submit.prevent="searchTag">
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
                        <th class="text-center">Title</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Content</th>
                        <th class="text-center">Active</th>
                        <th class=" text-center" style="width:110px">Function</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $idx => $post)
                    <tr class=" text-center">
                        <td>{{ $posts->firstItem() + $idx }}</td>
                        <td>{{ $post->post_title }}</td>
                        <td>
                            <img height="40px" width="40px" src="{{ asset('storage/images/' .$post->photo.'') }}" alt="post image">
                        </td>
                        <td>{{ $post->content }}</td>
                        <td>
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="Publish{{ $post->id }}"
                                wire:click="Publish({{ $post->id }})"
                                {{ $post->active ? 'checked' : '' }}>
                            <label class="form-check-label" for="Publish{{ $post->id }}"></label>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="/admin/view/post/{{ $post->id }}" wire:navigate class="btn btn-primary btn-sm mx-1">View</a>
                                <button wire:click="deletePost({{$post->id}})" wire:confirm="Are you sure you want to delete this?" class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
            <button onclick="history.back()" class="btn btn-secondary ms-3">Back</button>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->