<div class="card">
    {{-- here create a form to add new post --}}
    <div class="card-header">
        Edit Post
    </div>
    <div class="card-body">
        {{-- here we call save function --}}
        <form class="my-3" wire:submit="update">
            <div class="col-sm-10">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" wire:model="post_title" value="{{ $post->post_title }}"
                        id="floatingInput" placeholder="name@example.com">
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
                    <select wire:model="selectedTags" class="selectpicker" id="selectedTags" multiple
                        data-live-search="true">
                        <option value="" disabled>Choose tags</option>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" @if (in_array($tag->id, $selectedTags)) selected @endif>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('selectedTags')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-sm-10">
                <div class="form-floating mb-3">
                    <textarea class="form-control" wire:model="content" id="floatingTextarea" placeholder="Your post goes here.."
                        rows="5">{{ $post->content }}</textarea>
                    <label for="floatingTextarea">Your post goes here..</label>
                </div>

                @error('content')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-sm-10">
                <label for="">post image</label>
                <div class="form-floating mb-3">
                    <img height="80px" width="80px" src="{{ asset('storage/images/' . $post->photo) }}"
                        alt="post image">
                    <input type="file" class="form-control" placeholder="post details" wire:model="photo"
                        id="">
                </div>
                @error('photo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/my/posts" wire:navigate class="btn btn-secondary">cancel</a>
    </div>
    </form>
</div>
</div>
