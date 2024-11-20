<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\PostViewers;
use Livewire\Component;

class GlobalSearch extends Component
{
    public $search = "";
    public function addViewers($postId)
    {
        $addviewer = new PostViewers;
        $addviewer->user_id = auth()->user()->id;
        $addviewer->post_id = $postId;
        $addviewer->save();
    }
    public function render()
    {
        $result = [];
        if (strlen($this->search) >= 1) {
            $result = Post::with(['user', 'tags'])
                ->where('post_title', 'LIKE', "%{$this->search}%")
                ->orWhereHas('user', function ($q) {
                    $q->where('name', 'LIKE', "%{$this->search}%");
                })
                ->orWhereHas('tags', function ($q) {
                    $q->where('name', 'LIKE', "%{$this->search}%");
                })->limit(7)
                ->get();
        }
        return view('livewire.global-search', [
            'results' => $result
        ]);
    }
}
