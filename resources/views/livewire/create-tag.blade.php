<div class="card">
    {{-- here create a form to add new tag --}}
    <div class="card-header">
        Add new tag
    </div>

    <div class="card-body">
        {{-- here we call save function --}}
        <form class="my-3" wire:submit="save">
            @csrf
            <div class="col-sm-10">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" wire:model="tag_name"
                        id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Tag name...</label>
                </div>
                @error('content')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            <a href="/admin/tag" wire:navigate class="btn btn-secondary">cancel</a>
        </form>
    </div>
</div>
</div>