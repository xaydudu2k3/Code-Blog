<div class="card">
    {{-- here create a form to add new post --}}
    <div class="card-header">
        add new post
    </div>

    <div class="card-body">
        {{-- here we call save function --}}
        <form class="my-3" wire:submit="save" enctype="multipart/form-data">
            @csrf
            <div class="col-sm-10">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" wire:model="post_title" id="floatingInput"
                        placeholder="name@example.com">
                    <label for="floatingInput">Post Title</label>
                </div>
                {{-- show validation error here --}}
                @error('post_title')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-sm-10">
                <div class="form-floating mb-3">
                    <span>Choose tags</span>
                    <select wire:model="selectedTags" class="selectpicker" id="selectTags"
                        multiple data-live-search="true">
                        <option value="" disabled>Choose tags</option>
                        @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('selectedTags')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-sm-10">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" wire:model="content"
                        id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Your post goes here.. </label>
                </div>
                @error('content')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-sm-10">
                <div class="form-floating mb-3">
                    <input type="file" class="form-control" placeholder="post details" wire:model="photo"
                        id="">
                    <label for="floatingInput">Your post image</label>
                </div>
                @error('photo')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="/admin/home" wire:navigate class="btn btn-secondary">cancel</a>
        </form>
    </div>
</div>
</div>