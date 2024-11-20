<div class="card">
    {{-- here create a form to add new tag --}}
    <div class="card-header">
        Edit Tag
    </div>
    <div class="card-body">
        {{-- here we call save function --}}
        <form class="my-3" wire:submit="update">
            <div class="col-sm-10">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" wire:model="tag_name" value="{{ $tag->name}}"
                        id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Tag name...</label>
                </div>
                {{-- show validation error here --}}
                @error('tag_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/admin/tag" wire:navigate class="btn btn-secondary">cancel</a>
    </div>
    </form>
</div>
</div>