<?php

namespace App\Livewire;


use App\Models\User;
use App\Models\Follower;
use Livewire\Component;

class UserFollowing extends Component
{
    public $userId;
    public $followingUsers;
    public $image;
    public $user_data;
    public $search = '';
    public $count;
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

        $this->loadFollowingUsers();
    }


    public function loadFollowingUsers()
    {
        // $this->followingUsers = User::whereHas('followers', function ($query) {
        //     $query->where('follower_id', $this->userId);
        // })
        // ->where('name', 'like', '%'. $this->search .'%') 
        // ->get();
        // $this->count = $this->followingUsers->count();
        // $this->followingUsers = User::join('followers', 'followers.followed_id', '=', 'users.id')
        //     ->where('followers.follower_id', $this->userId)
        //     ->where('users.name', 'like', '%' . $this->search . '%')
        //     ->get();
        // $this->count = $this->followingUsers->count();
        $this->followingUsers = Follower::where('follower_id', $this->userId)
            ->with([
                'followed' => function ($query) {
                    $query->when($this->search, function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    });
                }   
            ])
            ->get()
            ->map(function ($follower) {
                $follower->followed->followed_at = $follower->created_at;
                return $follower->followed; 
            });

        // Đếm số lượng người dùng
        $this->count = $this->followingUsers->count();
    }


    public function searchUser()
    {
        // $this->followingUsers = User::whereHas('followers', function ($query) {
        //     $query->where('follower_id', $this->userId);
        // })
        // ->where('name', 'like', '%'. $this->search .'%') 
        // ->get();
        // $this->count = $this->followingUsers->count(); 
        $this->loadFollowingUsers();
    }


    public function clearSearch()
    {
        $this->search = '';
        // $this->searchUser();
        $this->loadFollowingUsers();
    }

    public function render()
    {
        return view('livewire.user-following', [
            'followingUsers' => $this->followingUsers,
            'count' => $this->count,

        ]);
    }
}