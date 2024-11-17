    <div class="row g-3">
        <div class="col-12 mb-3">
            <!-- Dropdown for sorting posts -->
            <select class="form-select" wire:model="sortOption">
                <option value="latest">Mới nhất</option>
                <option value="oldest">Cũ nhất</option>
                <option value="most_viewed">Nhiều lượt xem nhất</option>
            </select>
        </div>
        {{-- here we will loop through all posts.. --}}
        @foreach ($posts as $post)
            <div class="col-xl-4 col-md-6 col-sm-12 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/images/' . $post->photo) }}" height="200px" alt=""
                        class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->post_title }}</h5>
                        <livewire:tags-component :postId="$post->id" />
                        <p>{{ str($post->content)->words(10) }}<a href="/view/post/{{ $post->id }}" wire:navigate
                                wire:click="addViewers({{ $post->id }})" class="card-link mx-1">read more</a></p>
                        {{-- this functions will truncate the words above 10 --}}
                        <div class="row">
                            <div class="col-xl-6">
                                <small class="text-muted">{{ date('d-m-Y h:i', strtotime($post->created_at)) }}</small>
                            </div>
                            <livewire:like-component :postId="$post->id" />
                        </div>
                    </div>
                    <div class="card-footer">
                        {{-- here we use anchor tag to make both profile-image component and name be clickable --}}
                        <a href="/view/profile/{{ $post->user_id }}" wire:navigate>
                            <livewire:profile-image :userId="$post->user_id" />
                            <span class="text-muted mx-3 text-capitalize my-1"> {{ $post->name }}</span>
                        </a>
                        <livewire:follow-component :followedId="$post->followedId" />
                    </div>
                </div>
            </div>
        @endforeach

    </div>
