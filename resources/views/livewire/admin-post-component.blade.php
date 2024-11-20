<style>
    .form-check-input {
        width: 3rem;
        height: 1.5rem;
    }
    .form-check-input:checked {
        background-color: #28a745; 
        border-color: #28a745;
    }
    .form-check-input {
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }
    .form-check-label {
        font-size: 1.2rem;
        margin-left: 0.5rem;
        color: #212529;
    }
</style>
<div class="container mt-4">
    <h3 class="mb-3">List Posts</h3>

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

    {{-- <div class="list-group">
        @foreach ($posts as $post)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{ $post->post_tittle }} {{ $post->content }} {{ $post->user->name ?? 'N/A' }}

                </span>
                <div>
                    <a href="/admin/view/profile/{{ $post->id }}" wire:navigate class="btn btn-primary btn-sm mx-2">View</a>
                    <button class="btn btn-danger btn-sm" wire:click="deletePost({{ $post->id }})">Delete</button>
                </div>
            </div>
        @endforeach
    </div> --}}
    <div class="list-group">
        <div class="list-group-item">
            <div class="row font-weight-bold">
                <div class="col-md-2">Title</div>
                <div class="col-md-3">User</div>
                <div class="col-md-4">Content</div>
                <div class="col-md-3 text-center">Action</div>
            </div>
        </div>
       

        @foreach ($posts as $post)
            <div class="list-group-item">
                <div class="row align-items-center">

                    <div class="col-md-2">
                        {{ $post->post_title }}
                    </div>
                    
                    <div class="col-md-3">
                        {{ $post->user->name ?? 'N/A' }}
                        
                    </div>
                    
                    <div class="col-md-4">
                        {{ $post->content }}
                    </div>

                    <div class="col-md-3 text-center">
                        <a href="/admin/view/post/{{ $post->id }}" wire:navigate class="btn btn-primary btn-sm mx-1">View</a>
                        <button  wire:click="hehe({{$post->id}})" wire:confirm="Are you sure you want to delete this?" class="btn btn-danger btn-sm">Delete</button>
                        <div class="form-check form-switch d-inline-block">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                id="toggleVisibility{{ $post->id }}" 
                                wire:click="toggleVisibility({{ $post->id }})" 
                                {{ $post->is_visible ? 'checked' : '' }}>
                            <label class="form-check-label" for="toggleVisibility{{ $post->id }}"></label>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>