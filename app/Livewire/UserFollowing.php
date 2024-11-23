<?php

namespace App\Livewire;


use App\Models\User;
use Livewire\Component;

class UserFollowing extends Component
{
    public $userId;
    public $followingUsers;
    public $image;
    public $user_data;
    public $search = '';
    public $count;


    public function mount($userId)
    {
        $this->userId = $userId;
        $this->loadFollowingUsers();
        $this->user_data = User::join('user_profiles','user_profiles.user_id','=','users.id')
        ->where('user_profiles.user_id',$userId)
        ->first();
    }


    public function loadFollowingUsers()
    {
        $this->followingUsers = User::whereHas('followers', function ($query) {
            $query->where('follower_id', $this->userId);
        })
        ->where('name', 'like', '%'. $this->search .'%') 
        ->get();
        $this->count = $this->followingUsers->count();
    }


    public function searchUser()
    {
        $this->followingUsers = User::whereHas('followers', function ($query) {
            $query->where('follower_id', $this->userId);
        })
        ->where('name', 'like', '%'. $this->search .'%') 
        ->get();
        $this->count = $this->followingUsers->count(); 
    }


    public function clearSearch()
    {
        $this->search = ''; 
        $this->searchUser(); 
    }

    public function render()
    {
        return view('livewire.user-following', [
            'followingUsers' => "$this->followingUsers",
            'count' => "$this->count",
            'search' => "$this->search"
        ]);
    }
}