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
        {{-- @foreach ($users as $user)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{ $user->name }} ({{ $user->email }})</span>
                <span>{{ $user->role ? "ADMIN" : "USER" }}</span>
                <div>
                    <a href="/admin/view/profile/{{ $user->id }}" wire:navigate class="btn btn-primary btn-sm mx-2">View</a>
                    <button wire:confirm="Are you sure you want to delete this?" class="btn btn-danger btn-sm" wire:click="deleteUser({{ $user->id }}) ">Delete</button>
                </div>
            </div>
        @endforeach --}}
        <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">User</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col" colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
             
                  <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role ? "ADMIN" : "USER"}}</td>
                    <td><a href="/admin/view/profile/{{ $user->id }}" wire:navigate class="btn btn-primary btn-sm">View</a><button wire:confirm="Are you sure you want to delete this?" class="btn btn-danger btn-sm ml-3" wire:click="deleteUser({{ $user->id }})">Delete</button></td>
                  </tr>
              @endforeach
            </tbody>
          </table>
    </div>
</div>