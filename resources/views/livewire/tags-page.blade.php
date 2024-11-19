<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h1 class="card-title">Danh sách tag</h1>

            <div class="card-tools">
                <a href="/create/tag" class="btn btn-outline-danger mx-2 text-left">Create</a>
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
                        <th class="text-center" style="width:110px">Function</th>
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
                                <button class="btn btn-danger btn-sm mx-1" wire:click="deleteUser({{ $tag->id }})">Delete</button>
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