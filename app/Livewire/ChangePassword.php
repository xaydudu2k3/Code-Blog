<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ChangePassword extends Component
{
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function change() {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|max:8|',
            'new_password_confirmation' => 'required|min:6|max:8|same:new_password'
        ]);

        if (!Hash::check($this->current_password, Auth::user()->password)) {
            $this->addError('current_password', 'The current password is incorrect');
            return;
        }
        Auth::user()->update([
            'password' => Hash::make($this->new_password),
        ]);
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        session()->flash('status', 'Password updated successfully!');
    }
    public function render()
    {
        return view('livewire.change-password');
    }
}
