<div class="dropdown-wrapper" style="position: relative;">
    <input type="text" wire:model.live="search" placeholder="Search" class="form-control" />
    @if ($results)
    <div class="dropdown-menu d-block mt-3"
        style="position: absolute; top: 100%; left: 0; right: 0; min-width: 400px;">
        @foreach ($results as $post)
        <a class="dropdown-item" href="/view/post/{{ $post->id }}"
            wire:click="addViewers({{ $post->id }})">
            <img src="{{ asset('storage/images/' . $post->photo) }}" width="50px" height="50px"
                alt="Post Image" class="post-img">
            <strong>{{ str($post->post_title)->words(5) }}</strong> by {{ $post->user->name }}
            <br>
            Tags:
            @foreach ($post->tags as $tag)
            <span class="badge bg-secondary">{{ $tag->name }}</span>
            @endforeach
        </a>
        @endforeach
    </div>
    @endif
</div>