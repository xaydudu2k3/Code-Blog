<div class="card">
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
    <div class="card-header align-items-center justify-content-between">
        <h1 class="card-title">List User</h1>
        <div class="d-flex align-items-center justify-content-between">
            <div class="search-bar">
                <form class="search-form d-flex align-items-center" wire:submit.prevent="searchUser">
                    <div class="position-relative">
                        <input
                            type="text"
                            name="search"
                            wire:model="search"
                            placeholder="Search"
                            title="Enter search keyword"
                            class="form-control">
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
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-center">User</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Role</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="text-center">
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role ? "ADMIN" : "USER"}}</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <a href="/admin/view/profile/{{ $user->id }}" wire:navigate class="btn btn-primary btn-sm mx-1">View</a>
                            <button wire:confirm="Are you sure you want to delete this?" class="btn btn-danger btn-sm mx-1" wire:click="deleteUser({{ $user->id }})">Delete</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="d-flex justify-content-center">
        {{ $users->links() }}
    </div>
</div>