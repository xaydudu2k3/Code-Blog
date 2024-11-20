<div class="container mt-4">
    <h3 class="mb-3">List User</h3>

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
        @foreach ($users as $user)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{ $user->name }} ({{ $user->email }})</span>
                <div>
                    <a href="/admin/view/profile/{{ $user->id }}" wire:navigate class="btn btn-primary btn-sm mx-2">View</a>
                    <button wire:confirm="Are you sure you want to delete this?" class="btn btn-danger btn-sm" wire:click="deleteUser({{ $user->id }}) ">Delete</button>
                </div>
            </div>
        @endforeach
    </div>
</div>