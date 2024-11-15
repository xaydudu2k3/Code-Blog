<form wire:submit="editUser">
<div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
    <div class="col-md-8 col-lg-9">
    <input wire:model="fullName" type="text" class="form-control" id="fullName" value="{{ $fullName }}">
    @error('fullName')
        <span class="text-danger">{{$message}}</span>
    @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
    <div class="col-md-8 col-lg-9">
    <textarea wire:model="about" class="form-control" id="about" style="height: 100px">{{ $about }}</textarea>
    @error('about')
        <span class="text-danger">{{$message}}</span>
    @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
    <div class="col-md-8 col-lg-9">
    <input wire:model="company" type="text" class="form-control" id="company" value="{{ $company }}">
    @error('company')
        <span class="text-danger">{{$message}}</span>
    @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
    <div class="col-md-8 col-lg-9">
    <input wire:model="job" type="text" class="form-control" id="Job" value="{{ $job }}">
    @error('job')
        <span class="text-danger">{{$message}}</span>
    @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
    <div class="col-md-8 col-lg-9">
    <input wire:model="country" type="text" class="form-control" id="Country" value="{{ $country }}">
    @error('country')
        <span class="text-danger">{{$message}}</span>
    @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
    <div class="col-md-8 col-lg-9">
    <input wire:model="address" type="text" class="form-control" id="Address" value="{{ $address }}">
    @error('address')
        <span class="text-danger">{{$message}}</span>
    @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
    <div class="col-md-8 col-lg-9">
    <input wire:model="phone" type="text" class="form-control" id="Phone" value="{{ $phone }}">
    @error('phone')
        <span class="text-danger">{{$message}}</span>
    @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
    <div class="col-md-8 col-lg-9">
    <input wire:model="twitter" type="text" class="form-control" id="Twitter" value="{{ $twitter }}">
    </div>
</div>

<div class="row mb-3">
    <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
    <div class="col-md-8 col-lg-9">
    <input wire:model="facebook" type="text" class="form-control" id="Facebook" value="{{ $facebook }}">
    </div>
</div>

<div class="row mb-3">
    <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
    <div class="col-md-8 col-lg-9">
    <input wire:model="instagram" type="text" class="form-control" id="Instagram" value="{{ $instagram }}">
    </div>
</div>

<div class="row mb-3">
    <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
    <div class="col-md-8 col-lg-9">
    <input wire:model="linkedin" type="text" class="form-control" id="Linkedin" value="{{ $linkedin }}">
    </div>
</div>

<div class="text-center">
    <button type="submit" class="btn btn-primary">Save Changes</button>
</div>
</form><!-- End Profile Edit Form -->