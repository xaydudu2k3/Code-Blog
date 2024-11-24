<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ViewUserComponent extends Component
{
    public $search = '';
    public function deleteUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete();
            session()->flash('message', 'Deleted Successfully!');
        } else {
            session()->flash('error', 'Not Found');
        }
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
        $users = User::where('name', 'like', '%' . $this->search . '%')->paginate(8);
        return view('livewire.view-user-component', ['users' => $users]);
    }
}
