<div class="row">
    <div class="col-12">
        <h3 class="mb-4">Followed by {{ $user_data->name }}: {{ $count }}</h3>
        {{-- <form class="search-form d-flex align-items-center" wire:submit.prevent="searchUser">
            <div class="position-relative">
                <input type="text" name="search" wire:model="search" placeholder="Search"
                       title="Enter search keyword" class="form-control">
                @if ($search)
                    <button type="button" class="btn btn-clear position-absolute end-0 top-0"
                            style="border: none; background: transparent; padding: 0.5rem;" wire:click="clearSearch">
                        ✖
                    </button>
                @endif
            </div>
            <button type="submit" title="Search" class="btn btn-primary ms-2">
                <i class="bi bi-search"></i>
            </button>
        </form> --}}

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Followed at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($followingUsers as $user)
                    <tr>

                        <td>
                            <img src="{{ asset('storage/images/' . ($user_data->image ?? 'default_user.jpg')) }}"
                                alt="Profile Photo" class="rounded-circle" height="40px" width="40px">
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="/profile/{{ $user->id }}" class="btn btn-sm btn-primary">View Profile</a>
                            {{-- <button>Unfollow</button> --}}
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
</div>