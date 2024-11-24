{{-- <div class="row"> --}}
<div class="card">
    <div class="card-header align-items-center justify-content-between">

        <h3 class="card-title">Followed by {{ $user_data->name }}: {{ $count }}</h3>
        <div class="d-flex align-items-center justify-content-between">
            {{-- <div class="search-bar">

                <form class="search-form d-flex align-items-center" wire:submit.prevent="searchUser">
                    <div class="position-relative">
                        <input type="text" name="search" wire:model="search" placeholder="Search"
                            title="Enter search keyword" class="form-control">
                        @if ($search)
                            <button type="button" class="btn btn-clear position-absolute end-0 top-0"
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
            </div> --}}
            {{-- <div class="search-bar">
                <form class="search-form d-flex align-items-center" wire:submit.prevent="searchUser">
                    <input type="text" name="search" wire:model="search" placeholder="Search title" title="Enter search keyword">
                    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
            </div> --}}
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Followed at</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($followingUsers as $user)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/images/' . ($user->image ?? 'default_user.jpg')) }}"
                                alt="Profile Photo" class="rounded-circle" height="40px" width="40px">
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->followed_at->format('d - m - Y') }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="{{ $role ? '/admin/view/profile' : '/view/profile' }}/{{ $user->id }}" class="btn btn-sm btn-primary">View
                                    Profile</a>
                                <livewire:follow-component :followedId="$user->id" />
                            </div>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</div>
{{-- </div> --}}
