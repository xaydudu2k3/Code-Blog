<?php

namespace App\Livewire;

use App\Models\Follower;
use App\Notifications\UserFollowedNotification;
use Livewire\Component;

class FollowComponent extends Component
{
    public $followed_id;
    public $IFollowed; //this will be boolean
    public $number_followers;
    public function mount($followedId){
        $this->followed_id = $followedId;
        $this->number_followers = Follower::where('followed_id',$this->followed_id)->count();

        // 
         $checker = Follower::where([['follower_id',auth()->user()->id],['followed_id',$this->followed_id]])
        ->first();

        $this->IFollowed = $checker == null ? 0 : 1;
    }

    public function followUnfollow()
    {
        $checker = Follower::where([['follower_id', auth()->user()->id], ['followed_id', $this->followed_id]])->first();

        if ($checker == null) {
            $createFollow = new Follower;
            $createFollow->follower_id = auth()->user()->id;
            $createFollow->followed_id = $this->followed_id;
            $createFollow->save();

            // Gửi thông báo
            $followedUser = $createFollow->followed;
            $followedUser->notify(new UserFollowedNotification(auth()->user()));
        } else {
            Follower::where([['follower_id', auth()->user()->id], ['followed_id', $this->followed_id]])->delete();
        }

        $this->number_followers = Follower::where('followed_id', $this->followed_id)->count();
        $this->IFollowed = $checker == null ? 0 : 1;
    }

    public function render()
    {
        return view('livewire.follow-component',[]);
    }
}
