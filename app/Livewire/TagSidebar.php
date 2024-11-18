<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Component;

class TagSidebar extends Component
{
    public $tags = [];

    public function mount() {
        $this->tags = Tag::all();
    }
    public function render()
    {
        return view('livewire.tag-sidebar', [
            'tags' => $this->tags,
        ]);
    }
}
