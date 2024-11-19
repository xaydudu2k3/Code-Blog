<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ViewUserComponent extends Component
{
    public $users;

    public function mount()
    {
        $this->users = User::all();
    }

    public function deleteUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete();
            $this->users = User::all();
            session()->flash('message', 'Deleted Successfully!');
        } else {
            session()->flash('error', 'Not Found');
        }
    }

    public function render()
    {
        return view('livewire.view-user-component');
    }
}
