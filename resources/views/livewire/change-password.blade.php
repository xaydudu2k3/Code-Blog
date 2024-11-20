<div>
  @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
  @endif

  <form wire:submit="change">
      <div class="row mb-3">
          <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
          <div class="col-md-8 col-lg-9">
              <input type="password" wire:model="current_password" class="form-control" id="currentPassword">
              @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
      </div>

      <div class="row mb-3">
          <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
          <div class="col-md-8 col-lg-9">
              <input type="password" wire:model="new_password" class="form-control" id="newPassword">
              @error('new_password') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
      </div>

      <div class="row mb-3">
          <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
          <div class="col-md-8 col-lg-9">
              <input type="password" wire:model="new_password_confirmation" class="form-control" id="renewPassword">
              @error('new_password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
          </div>
      </div>

      <div class="text-center">
          <button type="submit" class="btn btn-primary">Change Password</button>
      </div>
  </form>
</div>
