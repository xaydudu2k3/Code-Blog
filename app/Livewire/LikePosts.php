<?php

namespace App\Livewire;

use App\Models\Like;
use App\Models\User;
use Livewire\Component;

class LikePosts extends Component
{
    public $user_id;
    public $name;
    public $search = '';
    public $count;
    public $role;

    public function mount($userId)
    {
        $this->user_id = $userId;
        $this->name = User::find($userId)->name;
        $this->role = auth()->user()->role;
    }
    public function searchTag()
    {
        $this->render();
    }
    public function deleteLike($likeId)
    {
        Like::where('id', $likeId)->delete();
        session()->flash('message', 'The like was successfully deleted!');
        return redirect(request()->header('Referer'));
    }
    public function Publish($likeId)
    {
        $like = Like::find($likeId);
        if ($like) {
            $like->active = !$like->active;
            if ($like->active) {
                $like->publish = now();
            }
            $like->save();
            $message = $like->active
                ? 'The like is published!'
                : 'The like is hidden!';
            session()->flash('message', $message);
        } else {
            session()->flash('error', 'like not found!');
        }
    }
    public function clearSearch()
    {
        $this->search = '';
        $this->searchTag(); 
    }
    public function render()
    {
        $likes = Like::join('posts', 'posts.id', '=', 'likes.post_id')
            ->where('likes.user_id', $this->user_id)
            ->where('posts.post_title', 'like', '%' . $this->search . '%')
            ->orderBy('likes.created_at', 'desc')
            ->paginate(6, ['likes.*','posts.id']);
            $this->count = $likes->count();
        return view('livewire.like-posts', [
            'likes' => $likes,
            'name' => $this->name,
            'count' => $this->count
        ]);
    }
}
