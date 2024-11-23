<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class GuestProfileView extends Component
{
    public $user_data;
    public $admin;
    public $guestId;

    public function mount($guestId)
    {
        $this->user_data = User::join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
            ->where('user_profiles.user_id', $guestId) //here will be the id of the other user/post publisher
            ->first();
        if (auth()->check()) {
            if (auth()->user()->role === 1) $this->admin = true;
            else $this->admin = false;
            $this->guestId = $guestId;
            if (auth()->user()->id == $this->guestId) {
                if ($this->admin) {
                    return redirect()->route('profile.admin');
                } else {
                    return redirect()->route('profile.user');
                }
            }
        }
    }
    public function render()
    {
        return view('livewire.guest-profile-view', [
            'admin' => "$this->admin",
            'guestId' => "$this->guestId"
        ]);
    }
}
