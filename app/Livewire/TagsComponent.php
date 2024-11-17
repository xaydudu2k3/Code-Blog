<?php

namespace App\Livewire;

use App\Models\Like;
use App\Models\Post;
use Livewire\Component;

class TagsComponent extends Component
{
  public $post;
  public $tags;

  public function mount($postId)
  {
    $this->post = Post::find($postId);
    $this->tags = $this->post->tags->pluck('name')->toArray();
  }

  public function render()
  {
    return view('livewire.tags-component');
  }
}
