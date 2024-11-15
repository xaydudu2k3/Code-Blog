<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\UserProfile;

class ProfileDetailsEdit extends Component
{
    public $fullName; //the models from the form

    public $about;
    public $company;
    public $job;
    public $country;
    public $address;
    public $phone;
    public $twitter;
    public $facebook;
    public $linkedin;
    public $instagram;
    public function mount($user_data){
        $this->fullName = $user_data->name;
        $this->about = $user_data->about;
        $this->company = $user_data->company;
        $this->job = $user_data->job;
        $this->country = $user_data->country;
        $this->address = $user_data->address;
        $this->phone = $user_data->phone;
        $this->twitter = $user_data->twitter;
        $this->facebook = $user_data->facebook;
        $this->linkedin = $user_data->linkedin;
        $this->instagram = $user_data->instagram;
    }
    public function editUser(){
        $this->validate([
            'fullName' => 'required',
            
        ]);
        
        $editUser = UserProfile::where('user_id',auth()->user()->id)->update([
            'about' => $this->about,
            'company' => $this->company,
            'job' => $this->job,
            'country' => $this->country,
            'address' => $this->address,
            'phone' => $this->phone,
            'twitter' => $this->twitter,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'linkedin' => $this->linkedin,
        ]);

        // update full name on users table
        $updateUsersTable = User::where('id',auth()->user()->id)->update([
            'name' => $this->fullName
        ]);
        // this ensure image is updated
        return $this->redirect('/profile',navigate: true);
    }
    public function render()
    {
        return view('livewire.profile-details-edit');
    }
}
