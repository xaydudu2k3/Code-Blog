<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header align-items-center justify-content-between">
            <h1 class="card-title">List tags</h1>
            <div class="d-flex align-items-center justify-content-between">
                <div class="search-bar">
                    <form class="search-form d-flex align-items-center" wire:submit.prevent="searchTag">
                        <input type="text" name="search" wire:model="search" placeholder="Search" title="Enter search keyword">
                        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                    </form>
                </div>
                <div class="card-tools">
                    <a href="/create/tag" class="btn btn-outline-danger mx-2 text-left">Create</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">Tag name</th>
                        <th class="text-center">Created at</th>
                        <th class="text-center">Updated at</th>
                        <th class="text-center" style="width:110px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tags as $tag)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->created_at }}</td>
                        @if ($tag->updated_at != null)
                        <td>{{ $tag->updated_at }}</td>
                        @else
                        <td>{{ $tag->created_at }}</td>
                        @endif
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="/edit/tag/{{$tag->id}}" wire:navigate class="btn btn-primary btn-sm mx-1">Edit</a>
                                <button class="btn btn-danger btn-sm mx-1" wire:click="deleteTag({{ $tag->id }})">Delete</button>
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