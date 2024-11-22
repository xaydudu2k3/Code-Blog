<div class="container mt-4">
    <h3 class="mb-3">List Posts: {{ $count }}</h3>
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

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="list-group">
        <div class="list-group-item">
            <div class="row font-weight-bold">
                <div class="col-md-2"><b>Image</b></div>
                <div class="col-md-2"><b>Title</b></div>
                <div class="col-md-2"><b>User</b></div>
                <div class="col-md-3"><b>Content</b></div>
                <div class="col-md-3 text-center"><b>Action</b></div>
            </div>
        </div>
       

        @foreach ($posts as $post)
            <div class="list-group-item">
                <div class="row align-items-center">

                    <div class="col-md-2">
                        <img height="40px" width="40px" src="{{ asset('storage/images/' .$post->photo.'') }}" alt="post image">
                    </div>
                    
                    <div class="col-md-2">
                        {{ $post->post_title }}
                    </div>
                    
                    <div class="col-md-2">
                        {{ $post->user->name ?? 'N/A' }}
                        
                    </div>
                    
                    <div class="col-md-3">
                        {{ $post->content }}
                    </div>

                    <div class="col-md-3 text-center">
                        <a href="/admin/view/post/{{ $post->id }}" wire:navigate class="btn btn-primary btn-sm mx-1">View</a>
                        <button  wire:click="deletePost({{$post->id}})" wire:confirm="Are you sure you want to delete this?" class="btn btn-danger btn-sm">Delete</button>
                        
                        <div class="form-check form-switch d-inline-block">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                id="Publish{{ $post->id }}" 
                                wire:click="Publish({{ $post->id }})" 
                                {{ $post->active ? 'checked' : '' }}>
                            <label class="form-check-label" for="Publish{{ $post->id }}"></label>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>