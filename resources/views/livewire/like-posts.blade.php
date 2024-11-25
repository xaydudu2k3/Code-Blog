<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header align-items-center justify-content-between">
            <h1 class="card-title">List Likes by {{ $name }}</h1>
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
                                class="form-control">
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
                        <th class="text-center">#</th>
                        <th class="text-center">Title</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Content</th>
                        <th class=" text-center" style="width:110px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($likes as $idx => $like)
                    <tr class=" text-center">
                        <td>{{ $likes->firstItem() + $idx }}</td>
                        <td>{{ $like->post->post_title }}</td>
                        <td>
                            <img height="40px" width="40px" src="{{ asset('storage/images/' .$like->post->photo.'') }}" alt="like image">
                        </td>
                        <td>{{ str($like->post->content)->words(10) }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                @if ($role)
                                <a href="/admin/view/post/{{ $like->post->id }}" wire:navigate class="btn btn-primary btn-sm mx-1">View</a>
                                <button wire:click="deleteLike({{$like->id}})" wire:confirm="Are you sure you want to delete this?" class="btn btn-danger btn-sm">Delete</button>
                                @else
                                <a href="/view/post/{{ $like->post->id }}" wire:navigate class="btn btn-primary btn-sm mx-1">View</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $likes->links() }}
            </div>
            <button onclick="history.back()" class="btn btn-secondary ms-3">Back</button>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->