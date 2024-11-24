<style>
  .social-links .social-icon {
      font-size: 1.5rem;
      color: #555;
      transition: color 0.3s, transform 0.3s;
  }

  .social-links .social-icon:hover {
      color: #007bff;
      transform: scale(1.2);
  }

  .social-buttons {
      display: grid !important;
      grid-template-columns: repeat(2, 1fr);
      gap: 15px;
      justify-items: center;
      margin-top: 20px;
  }

  .social-buttons a {
      display: inline-block;
      font-size: 0.9rem;
      /* Giảm kích thước font */
      font-weight: 600;
      padding: 8px 12px;
      /* Giảm khoảng cách padding */
      border-radius: 8px;
      text-decoration: none;
      width: 120px;
      /* Thu nhỏ width của nút */
      text-align: center;
      color: white;
      transition: all 0.3s ease;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  }

  .btn-like {
      background-color: #0d6efd;
  }

  .btn-like:hover {
      background-color: #084298;
      transform: scale(1.05);
  }

  .btn-post {
      background-color: #198754;
  }

  .btn-post:hover {
      background-color: #146c43;
      transform: scale(1.05);
  }

  .btn-follow {
      background-color: #ffc107;
      color: black;
  }

  .btn-follow:hover {
      background-color: #d39e00;
      transform: scale(1.05);
  }

  .btn-comment {
      background-color: #17a2b8;
  }

  .btn-comment:hover {
      background-color: #117a8b;
      transform: scale(1.05);
  }
</style>
       <div class="row">
        <div class="col-xl-4">
         
          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                <img height="100px" width="100px" class="rounded-circle"

                    src="{{ asset('storage/images/' . $user_data->image ?? "image_default.jpg")  }}" alt="profile image">
                <h2>{{ $user_data->name ?? '' }}</h2>
                <h4 class="text-muted">{{ $user_data->job }}</h4>
                <div class="social-links mt-2 d-flex justify-content-center gap-4">
                    <a href="#" class="social-icon twitter"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="social-icon facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon linkedin"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
            <div class="social-buttons mt-4">
                @if ($role) 
                <a href="/admin/view/like/{{$id}}" class="btn-like"><i class="bi bi-hand-thumbs-up"></i> LikedPosts</a>
                <a href="/admin/view/guestpost/{{ $id }}" class="btn-post"><i class="bi bi-pencil-square"></i> Post</a>
                <a href="/admin/view/following/{{ $id }}"  class="btn-follow mb-3"><i class="bi bi-person-plus"></i> Following</a>
                <a href="/admin/view/comment/{{ $id }}" class="btn-comment mb-3"><i class="bi bi-chat-dots"></i> Comment</a>
                
                @else
                <a href="/my/like/{{$id}}" class="btn-like"><i class="bi bi-hand-thumbs-up"></i> LikedPosts</a>
                <a href="/my/posts" class="btn-post"><i class="bi bi-pencil-square"></i> Post</a>
                <a href="/my/following/{{ $id }}" class="btn-follow mb-3"><i class="bi bi-person-plus"></i> Following</a>
                <a href="/my/comments/{{ $id }}" wire:navigate class="btn-comment mb-3"><i class="bi bi-chat-dots"></i> Comment</a>
                @endif
               
            </div>
        </div>
        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic">{{$user_data->about ?? ''}}</p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{$user_data->name ?? ''}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company</div>
                    <div class="col-lg-9 col-md-8">{{$user_data->company ?? ''}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Job</div>
                    <div class="col-lg-9 col-md-8">{{$user_data->job ?? ''}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8">{{$user_data->country ?? ''}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">{{$user_data->address ?? ''}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">(84) {{$user_data->phone ?? ''}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{$user_data->email ?? ''}}</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  
                    <livewire:profile-image-edit :existingImage="$user_data->image" />
                        {{-- this is to pass image from datbase to edit image component --}}
                        {{-- create component for the remaining form --}}
                    <livewire:profile-details-edit :user_data="$user_data" />

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End settings Form -->

                </div>

                 <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                {{--  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form> --}}
                  <!-- End Change Password Form -->
                  <livewire:change-password />

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
