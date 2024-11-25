<?php

namespace App\Livewire;


use App\Models\User;
use App\Models\Follower;
use Livewire\Component;

class UserFollowing extends Component
{
    public $userId;
    public $image;
    public $user_data;
    public $search = '';
    public $date;
    public $role;


    public function mount($userId)
    {
        // $this->userId = $userId;
        // $this->loadFollowingUsers();
        // $this->user_data = User::join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
        //     ->where('user_profiles.user_id', $userId)
        //     ->first();
        $this->userId = $userId;
        $this->role = auth()->user()->role;

        // Lấy thông tin user và profile
        $this->user_data = User::join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
            ->where('users.id', $userId)
            ->select('users.*', 'user_profiles.*')
            ->first();
        $this->date = User::join('followers', 'followers.followed_id', '=', 'users.id')
            ->where('followers.follower_id', $this->userId)
            ->select('followers.created_at') // Lấy trường created_at của bảng followers
            ->get();
    }


    public function searchUser()
    {
        $this->render();
    }


    public function clearSearch()
    {
        $this->search = '';
        $this->render();
    }

    public function render()
    {
        $followingUsers = Follower::where('follower_id', $this->userId)
            ->with([
                'followed.profile',
                'followed' => function ($query) {
                    $query->when($this->search, function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    });
                }
            ])
            ->paginate(6) // Apply pagination here
            ->through(function ($follower) {
                $follower->followed->followed_at = $follower->created_at;
                return $follower->followed; // Transform each item
            });

        // Đếm số lượng người dùng
        $count = $followingUsers->count();
        return view('livewire.user-following', [
            'followingUsers' => $followingUsers,
            'count' => $count,

        ]);
    }
}
